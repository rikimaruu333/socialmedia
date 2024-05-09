
$(document).ready(function() {
    // Function to extract query parameter from URL
    function getParameterByName(name) {
        var url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    // Function to populate user profile info
    function populateProfileInfo(userId) {
        $.ajax({
            url: 'userprofileinfo.php',
            type: 'GET',
            dataType: 'json',
            data: { user_id: userId },
            success: function(response) {
                if (response && !response.error) {
                    $('#nickname').val(response.nickname);
                    $('#firstname').val(response.firstname);
                    $('#lastname').val(response.lastname);
                    $('#gender').val(response.gender);
                    $('#userId').val(response.user_id);
                    $('input[name="followingId"]').val(response.user_id);

                    $('#infonickname').html(response.nickname ? response.nickname : response.firstname + " " + response.lastname);
                    $('#inforealname').html(response.firstname + " " + response.lastname);
                    $('#userId').val(response.user_id);

                    if (response.profile) {
                        $('#selectedFile img').attr('src', response.profile);
                        $('.image img').attr('src', response.profile);
                        $('.content img').attr('src', response.profile);
                    }
                } else {
                    console.error('Error fetching user profile info:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user profile info:', error);
            }
        });
    }

    // Function to populate user posts
    function populatePosts(userId) {
        $.ajax({
            url: 'fetch_userprofileposts.php',
            type: 'GET',
            dataType: 'json',
            data: { user_id: userId },
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
    }

    // Function to populate card elements
    function populateCard(posts, container) {
        var cardContainer = $(container);
        var cardTemplate = $('#postTemplate').html();

        posts.forEach(function(post) {
            var timeAgo = moment(post.post_created).fromNow();
            var card = $(cardTemplate).clone();
            var currentUserID = post.currentUserID;
            card.find('.userImg').attr('src', post.profile);
            card.find('.userNickName').text(post.nickname || '');
            card.find('.userRealName').text(post.firstname + " " + post.lastname);
            card.find('.message').text(post.caption);
            card.find('.postImage img').attr('src', post.picture);
            card.find('.likes').html('5,489 likes &nbsp;&nbsp;&nbsp;' + post.comment_count + ' comments');
            card.find('.userImgComment').attr('src', post.profile);
            card.find('#post_id').val(post.post_id);
            card.find('.postTime').text(timeAgo);

            if (!post.caption) {
                card.find('.message').hide();
            }
            if (!post.picture) {
                cardContainer = $('.texts');
                card.find('.imgBg').hide();
            }

            cardContainer.append(card);
        });
    }

    // Function to check if the user is already following
    function checkFollowing() {
        var userId = getParameterByName('user_id');

        $.ajax({
            url: 'check_following.php',
            type: 'GET',
            dataType: 'json',
            data: { user_id: userId },
            success: function(response) {
                if (!response.error && response.isFollowing) {
                    $('.temp').hide();
                    $('.featurebox').show();
                    $('.postscontainer').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error checking following status:', error);
            }
        });
    }

    $('#followBtn').click(function() {
        var followingId = $('input[name="followingId"]').val();

        $.ajax({
            url: 'follow_user.php', // Replace with the actual URL to handle follow action
            type: 'POST',
            dataType: 'json',
            data: { following_id: followingId },
            success: function(response) {
                if (!response.error && response.success) {
                    // Update UI to reflect that the user is now following
                    $('.temp').hide();
                    $('.featurebox').show();
                    $('.postscontainer').show();
                } else {
                    console.error('Error following user:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error following user:', error);
            }
        });
    });

    // Call functions when the page loads
    var userId = getParameterByName('user_id');
    populateProfileInfo(userId);
    populatePosts(userId);
    checkFollowing();

    // Function to handle comment form submission
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
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Function to handle comment icon click event
    $(document).on('click', '.left .comment', function() {
        var postId = $(this).closest('.card').find('input[name="post_id"]').val();

        $.ajax({
            url: 'fetch_comments.php',
            type: 'POST',
            data: { post_id: postId },
            dataType: 'json',
            success: function(response) {
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
            var commentElement = $(commentTemplate).clone();
            var commentTime = moment(comment.comment_date).fromNow();
            var currentUserID = comment.currentUserID;
            var commentUserID = comment.user_id;

            commentElement.find('.cover').attr('src', comment.profile);
            commentElement.find('.userNickName').text(comment.nickname || '');
            commentElement.find('.userRealName').text(comment.firstname + " " + comment.lastname);
            commentElement.find('h4').text(comment.comment_content);
            commentElement.find('h5').text(commentTime);

            commentElement.find('input[name="comment_id"]').val(comment.comment_id);
            commentElement.find('input[name="user_id"]').val(comment.user_id);


            if (commentUserID === currentUserID) {
                commentElement.find('.commentClose').show();
                commentElement.find('.commentEdit').show();
            } else {
                commentElement.find('.commentEdit').hide();
                commentElement.find('.commentClose').hide();
            }

            commentContainer.append(commentElement);
        });

        $('#commentModal').show();
    }

    // Close modal when the close button is clicked
    $(document).on('click', '#commentModal .close', function() {
        $('#commentModal').hide();
    });

    function fetchFollowerFollowingCount(userId) {
        $.ajax({
            url: 'fetch_follow_count.php',
            type: 'GET',
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
    fetchFollowerFollowingCount(userId);

    
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