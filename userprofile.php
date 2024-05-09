<?php
session_start();

if (isset($_SESSION['USER'])) {
    $user = $_SESSION['USER'];
} else {
    header("Location: signup.php");
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Instagram</title>
    <link rel="shortcut icon" type="png" href="pics/instalogo.png">
    <link rel="stylesheet" href="userprofile.css">
</head>
<body>
    <div class="container">
        <aside class="side-panel">
            <div class="logo">
                <img src="pics/instagram.png" alt="Instagram Logo">
            </div>
            <nav class="navigation">
                <ul>
                    <li class="dashboard_btn">
                        <a href="home.php" title="Home">
                            <i class="bx bxs-home"></i>
                            <span class="nav-item">Home</span>
                        </a>
                    </li>
                    <li class="dashboard_btn">
                        <a href="profile.php" title="Profile">
                            <i class="bx bx-user"></i>
                            <span class="nav-item">Profile</span>
                        </a>
                    </li>
                    <li class="dashboard_btn">
                        <a href="searchpage.php" title="Search">
                            <i class="bx bx-search"></i>
                            <span class="nav-item">Search</span>
                        </a>
                    </li>
                    <li class="dashboard_btn">
                        <a href="logout.php" title="Log out">
                            <i class="bx bx-log-out"></i>
                            <span class="nav-item">Log out</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="posts">
            <div class="profilecontainer">
                <div class="profilecontainertop">
                    <div class="profile">
                        <div class="image">
                            <img src="pics/user.jpg" alt="" class="cover">
                        </div>
                    </div>
                    <div class="info">
                        <div class="info1">
                            <h3 id="infonickname"></h3>
                        </div>
                        <div class="info2">
                            <div class="post"><b id="postCount"></b> posts</div>
                            <div class="follower"><b id="followerCount"></b> followers</div>
                            <div class="following"><b id="followingCount"></b> following</div>
                        </div>
                        <div class="info3">
                            <h3 id="inforealname"></h3>
                        </div>
                    </div>
                </div>
                <div class="temp">
                    <img src="pics/privatepic.jpg" alt="">
                    <input type="hidden" name="followingId" value="">
                    <button id="followBtn">Follow</button>
                </div>
                <div class="featurebox" style="display: none;">
                    <div class="featurecontainer">
                        <div class="addfeaturecontainer">
                            <img src="pics/plussign.png" alt="">
                        </div>
                        <div class="span">
                            <span>New</span>
                        </div>
                    </div>
                    <div class="featurecontainer">
                        <div class="addfeaturecontainer">
                            <img src="pics/ml.png" alt="">
                        </div>
                        <div class="span">
                            <span>Story</span>
                        </div>
                    </div>
                    <div class="featurecontainer">
                        <div class="addfeaturecontainer">
                            <img src="pics/a.jpg" alt="">
                        </div>
                        <div class="span">
                            <span>Feature</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postscontainer" style="display: none;">
                <div class="postscontainerheader">
                    <i class="bx bx-grid"></i>
                    <h3>POSTS</h3>
                </div>
                <div class="postscontainertop">
                    <div class="pics">
                        
                    </div>
                    <div class="texts">

                    </div>
                </div>
                <div id="postTemplate" style="display: none;">
                    <div class="card">
                        <div class="top">
                            <div class="userDetails">
                                <div class="profileImg">
                                    <img src="" alt="" class="cover userImg">
                                </div>
                                <h3 class="userName"><span class="userNickName"></span><br><span class="userRealName"></span></h3>
                            </div>
                        </div>
                        <h4 class="message">
                        </h4>
                        <div class="imgBg postImage">
                            <img src="" alt="" class="cover">
                        </div>
                        <div class="btns">
                            <div class="left">
                                <img src="pics/heart.png" alt="" class="heart" onclick="likeButton()">
                                <img src="pics/comment.png" alt="" class="comment">
                            </div>
                            <div class="right">
                                <img src="pics/bookmark.png" alt="" class="bookmark">
                            </div>
                        </div>
                        <h4 class="likes"></h4>
                        <div class="addComments">
                            <div class="userImg">
                                <img src="" alt="" class="cover userImgComment">
                            </div>
                            <form class="commentForm">
                                <input type="hidden" name="post_id" id="post_id" value="">
                                <input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id'] ?>">
                                <input type="text" class="text" name="comment_content" placeholder="Add a comment..." required>
                                <button type="submit" class="postCommentIcon">
                                    <img src="pics/postcomment.png" alt="">
                                </button>
                            </form>
                        </div>
                        <h5 class="postTime"></h5>
                    </div>
                </div>
                <div id="commentModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Comments</h2>
                        <div id="commentContainer"></div>
                    </div>
                </div>

                <div id="commentTemplate" style="display: none;">
                    <div class="comment">
                        <div class="card">
                            <input type="hidden" name="comment_id" id="comment_id" value="">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div class="top">
                                <div class="userDetails">
                                    <div class="profileImg">
                                        <img src="" alt="" class="cover userImg">
                                    </div>
                                    <h3 class="userName"><span class="userNickName"></span><br><span class="userRealName"></p></h3>
                                </div>
                                <i class="commentEdit bx bxs-edit"></i>
                                <span class="commentClose">&times;</span>
                            </div>
                            <h4 class="message">
                            </h4>
                            <h5 class="postTime"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="editCommentModal" class="editCommentModal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Comment</h2>
            <form id="editCommentForm">
                <input type="hidden" name="comment_id" id="edit_comment_id" value="">
                <input type="text" class="text" name="comment_content" placeholder="Add new comment..." required>
                <button type="submit" class="postCommentIcon">
                    <img src="pics/postcomment.png" alt="">
                </button>
            </form>
            <h5 class="postTime"></h5>
        </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="userprofile.js"></script>
</body>
</html>