// Function to handle modal display
function displayModal(modalId, display) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = display;
    }
}

// Function to handle profile edit modal
$(document).ready(function() {
    var editProfileModalId = "editProfileModal";
    var editProfileBtn = document.querySelector("button");
    var editProfileCloseBtn = document.getElementsByClassName("close")[1];

    editProfileBtn.onclick = function() {
        displayModal(editProfileModalId, "block");
    }

    editProfileCloseBtn.onclick = function() {
        displayModal(editProfileModalId, "none");
    }

    window.onclick = function(event) {
        var editProfileModal = document.getElementById('editProfileModal');
        if (event.target == editProfileModal) {
            editProfileModal.style.display = 'none';
        }
    }
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
        url: 'profileinfo.php',
        type: 'GET',
        dataType: 'json', 
        success: function(response) {
            if (response && !response.error) {
                $('#nickname').val(response.nickname);
                $('#firstname').val(response.firstname);
                $('#lastname').val(response.lastname);
                $('#gender').val(response.gender);
                $('#userId').val(response.user_id);

                
                $('#infonickname').html(response.nickname ? response.nickname : response.firstname + " " + response.lastname);
                $('#inforealname').html(response.firstname + " " + response.lastname);

                $('#editProfileForm .nickname').html(response.nickname ? response.nickname : response.firstname + " " + response.lastname);
                $('#editProfileForm .realname').html(response.firstname + " " + response.lastname);

                $('#updatePostModal #user_id').val(response.user_id);
                $('#updatePostModal #postCardName').html(response.firstname + " " + response.lastname);
                

                if (response.profile) {
                    $('#selectedFile img').attr('src', response.profile);
                    $('.image img').attr('src', response.profile);
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



// Get the button and file input
var changeProfileBtn = document.getElementById("changeProfileBtn");
var profilePicInput = document.getElementById("profilePic");
var selectedFile = document.getElementById("selectedFile");

// When the button is clicked, trigger click event on file input
changeProfileBtn.onclick = function() {
    profilePicInput.click();
};

// When a file is selected, update the profile picture
profilePicInput.addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function() {
            selectedFile.querySelector('img').src = reader.result;
        }
        reader.readAsDataURL(file);
    }
});


$(document).ready(function() {
    $('#editProfileForm').submit(function(e) {
        e.preventDefault();
        
        // Get form data
        var formData = new FormData(this);
        
        // Send AJAX request
        $.ajax({
            url: 'profileprocess.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Profile updated successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Error updating profile. Please try again later.');
            }
        });
    });
});


$(document).ready(function() {
    $.ajax({
        url: 'fetch_userposts.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (!response.error) {
                $('#postCount').text(response.totalPosts);
                populateCard(response.postsWithPic, '.pics');

                populateCard(response.postsWithoutPic, '.texts');
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
    var cardContainer = $('.pics');
    var cardTemplate = $('#postTemplate').html(); // Get the HTML content of the template

    posts.forEach(function(post) {
        var timeAgo = moment(post.post_created).fromNow();

        // Clone the template and fill in dynamic data
        var card = $(cardTemplate).clone();
        card.find('.userImg').attr('src', post.profile);
        card.find('.userNickName').text(post.nickname || ''); // If nickname is undefined, set it to an empty string
        card.find('.userRealName').text(post.firstname + " " + post.lastname);
        card.find('.message').text(post.caption);
        card.find('.postImage img').attr('src', post.picture);
        card.find('.likes').html('5,489 likes &nbsp;&nbsp;&nbsp;' + post.comment_count + ' comments');
        card.find('.userImgComment').attr('src', post.profile);
        card.find('#post_id').val(post.post_id);
        card.find('#user_id').val(post.user_id);
        card.find('.postTime').text(timeAgo);

        // Hide elements if data is missing
        if (!post.caption) {
            card.find('.message').hide();
        }
        if (!post.picture) {
            cardContainer = $('.texts');
            card.find('.imgBg').hide();
        }
        
        // var currentUserID = post.currentUserID; 
        // var postUserID = post.user_id;

        // if (postUserID === currentUserID) {
        //     card.find('.close').show();
        // } else {
        //     card.find('.close').hide();
        // }

        // Append the card to the appropriate container
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

        // Show the modal
        $('#commentModal').show();
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


$(document).ready(function() {

    function fetchFollowerFollowingCount() {
        // Get the session user_id
        
        var userId = $('.useridtemplate input[name="user_id"]').val();

        $.ajax({
            url: 'fetch_session_follow_count.php',
            type: 'POST',
            dataType: 'json',
            data: { user_id: userId },
            success: function(response) {
                if (!response.error) {
                    $('#followerCount').text(response.followerCount);
                    $('#followingCount').text(response.followingCount);
                } else {
                    console.error('Error fetching follower and following count:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching follower and following count:', error);
            }
        });
    }

    // Call the function when the page loads
    fetchFollowerFollowingCount();
});
