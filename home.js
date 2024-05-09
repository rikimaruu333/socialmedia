

$(document).ready(function() {
    $.ajax({
        url: 'profileinfo.php',
        type: 'GET',
        dataType: 'json', 
        success: function(response) {
            if (response && !response.error) {

                $('#user_id').val(response.user_id);
                $('#postCardName').html(response.firstname + " " + response.lastname);

                $('#updatePostModal #user_id').val(response.user_id);
                $('#updatePostModal #postCardName').html(response.firstname + " " + response.lastname);

                if (response.profile) {
                    $('.content img').attr('src', response.profile);
                }
            } else {
                console.error('Error fetching user data:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user data:', error);
        }
    });
});

$(document).ready(function() {
    var closeModalBtn = $("#closeModalBtn");
    var postModal = $("#postModal");

    $("#openModalBtn").on("click", function() {
        postModal.addClass("show-modal");
    });

    closeModalBtn.on("click", function() {
        postModal.removeClass("show-modal");
    });

    $("#uploadImg").on("click", function() {
        $("#picture").click();
    });

    $("#addPostForm").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'create_post.php', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});

$(document).ready(function() {

    var unavailableBtnClicked = false;

    $(document).on('click', '.cardEdit', function() {
        var card = $(this).closest('.card');
        var postId = card.find('#post_id').val();
        var caption = card.find('.message').text();
        var pictureSrc = card.find('.imgBg img').attr('src');

        $('#updatePostModal #post_id').val(postId);
        $('#updatePostModal #caption').val(caption);
        $('#updatePostModal #updatePicture').attr('src', pictureSrc);

        $('#updatePostModal').addClass("show-modal");
    });

    $('#uploadUpdateImgUnavailable').on('click', function() {
        console.log("unavailableBtnClicked");
        $('#updatePicture').val('');
        $('#updatePostForm').find('input[name="picture"]').val('');

        unavailableBtnClicked = true;
        console.log(unavailableBtnClicked);
    });

    $("#closeUpdateModalBtn").on("click", function() {
        $('#updatePostModal').removeClass("show-modal");
    });

    $("#uploadUpdateImg").on("click", function() {
        $("#updatePicture").click();
    });

    $("#updatePostForm").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var updatePicture = $('#updatePicture')[0].files[0];
        if (!updatePicture) {
            formData.delete('picture');
        }

        formData.append('unavailable_btn_clicked', unavailableBtnClicked);

        $.ajax({
            url: 'update_post.php', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});



$(document).ready(function() {
    $.ajax({
        url: 'fetch_allposts.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && !response.error) {
                populateCard(response);
            } else {
                console.error('Error fetching posts:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching posts:', error);
        }
    });
});


function populateCard(posts) {
    var cardContainer = $('.posts');
    var postTemplate = $('#postTemplate');

    posts.forEach(function(post) {
        var timeAgo = moment(post.post_created).fromNow();

        var card = postTemplate.clone();

        var userDetails = card.find('.userDetails');
        var profileImg = userDetails.find('.profileImg');
        var userImg = profileImg.find('img');
        
        var currentUserID = post.currentUserID;
        var postUserID = post.user_id;

        userImg.attr('src', post.profile);

        var userName = userDetails.find('.userName');
        if (post.nickname) {
            userName.find('.userNickName').text(post.nickname);
            userName.find('.userRealName').text(post.firstname + " " + post.lastname);
        } else {
            userName.find('.userRealName').text(post.firstname + " " + post.lastname);
        }

        card.find('.message').text(post.caption);
        var imgBg = card.find('.imgBg');
        if (!post.picture) {
            imgBg.hide();
        } else {
            imgBg.find('img').attr('src', post.picture);
        }
        card.find('.likes').html('5,489 likes <span id="comments">' + "&nbsp;&nbsp;&nbsp;" +post.total_comments + ' comments</span>');
        card.find('.userImgComment').attr('src', post.profile);
        card.find('#post_id').val(post.post_id);
        card.find('#user_id').val(currentUserID);
        card.find('.postTime').text(timeAgo);

        if (postUserID === currentUserID) {
            card.find('.cardClose').show();
            card.find('.cardEdit').show();
        } else {
            card.find('.cardEdit').hide();
            card.find('.cardClose').hide();
        }

        card.removeClass('postTemplate').show(); 
        cardContainer.append(card);
    });
}


$(document).ready(function() {
    $(document).on('submit', '.commentForm', function(e) {
        e.preventDefault(); 

        var form = $(this);
        var postId = form.find('input[name="post_id"]').val();
        var userId = form.find('input[name="user_id"]').val();
        var commentContent = form.find('input[name="comment_content"]').val();

        $.ajax({
            url: 'add_comment.php',
            type: 'POST',
            data: {
                post_id: postId,
                user_id: userId,
                comment_content: commentContent
            },
            dataType: 'json', 
            success: function(response) {
                location.reload();
                // form.find('input[name="comment_content"]').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
            }
        });
    });
});


$(document).ready(function() {
    // Function to handle comment icon click event
    $(document).on('click', '.left .comment', function() {
        // Get the post ID associated with the clicked comment icon
        var postId = $(this).closest('.card').find('input[name="post_id"]').val();

        $.ajax({
            url: 'fetch_comments.php',
            type: 'POST',
            data: { post_id: postId },
            dataType: 'json',
            success: function(response) {
                // Populate the modal with fetched comments
                populateCommentsModal(response.comments);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Function to populate modal with comments
    function populateCommentsModal(comments) {
        var commentContainer = $('#commentContainer');
        commentContainer.empty(); // Clear previous content

        var commentTemplate = $('#commentTemplate').html();

        comments.forEach(function(comment) {
            // Clone the template
            var commentElement = $(commentTemplate).clone();
            var commentTime = moment(comment.comment_date).fromNow();

            // Populate the cloned template with data
            commentElement.find('.cover').attr('src', comment.profile);
            commentElement.find('.userNickName').text(comment.nickname || ''); // If nickname is undefined, set it to an empty string
            commentElement.find('.userRealName').text(comment.firstname + " " + comment.lastname);  
            commentElement.find('h4').text(comment.comment_content);
            commentElement.find('h5').text(commentTime);
            commentElement.find('input[name="comment_id"]').val(comment.comment_id);
            commentElement.find('input[name="user_id"]').val(comment.user_id);
            
            var currentUserID = comment.currentUserID; 
            var commentUserID = comment.user_id;

            if (commentUserID === currentUserID) {
                commentElement.find('.commentClose').show();
                commentElement.find('.commentEdit').show();
            } else {
                commentElement.find('.commentEdit').hide();
                commentElement.find('.commentClose').hide();
            }

            // Append the populated template to the comment container
            commentContainer.append(commentElement);
        });

        // Show the modal and update its width
        var modalWidth = 1000; // Adjust this value as needed
        $('#commentModal').width(modalWidth).show();
    }

    // Close modal when the close button is clicked
    $(document).on('click', '#commentModal .close', function() {
        $('#commentModal').hide();
    });
});




$(document).ready(function() {
    $(document).on('click', '.card .top .cardClose', function() {
        var postId = $(this).closest('.card').find('#post_id').val();

        if (confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: 'delete_post.php',
                type: 'POST',
                data: { post_id: postId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#post_' + postId).remove();
                        location.reload();
                    } else {
                        console.error('Error deleting post:', response.error);
                        alert('Error deleting post: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting post:', error);
                    alert('Error deleting post: ' + error);
                }
            });
        }
    });
});


$(document).ready(function() {
    $(document).on('click', '.card .top .commentClose', function() {
        var commentId = $(this).closest('.card').find('#comment_id').val();

        if (confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: 'delete_comment.php',
                type: 'POST',
                data: { comment_id: commentId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#comment_' + commentId).remove();
                        location.reload();
                    } else {
                        console.error('Error deleting comment:', response.error);
                        alert('Error deleting comment: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting comment:', error);
                    alert('Error deleting comment: ' + error);
                }
            });
        }
    });
});

// Event listener for edit comment button
$(document).on('click', '.comment .commentEdit', function(event) {
    var card = $(this).closest('.comment');
    var commentId = card.find('input[name="comment_id"]').val();
    var content = card.find('.input[name="comment_content"]').val();

    $('#edit_comment_id').val(commentId);
    $('#edit_comment_content').val(content);

    $('#editCommentModal').css('display', 'block');
});

// Event listener for closing the edit comment modal
$(document).on('click', '#editCommentModal .close', function(event) {
    $('#editCommentModal').css('display', 'none');
});

// Submit event listener for edit comment form
$('#editCommentForm').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: 'update_comment.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Comment updated successfully!');
                location.reload();
            } else {
                alert('Error updating comment: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating comment:', error);
            alert('Error updating comment. Please try again later.');
        }
    });
});
