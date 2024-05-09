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
    <link rel="stylesheet" href="home.css">
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
                        <a href="" title="Home">
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
            <div class="postcardcontainer">
                <div class="modal" id="postModal">
                    <div class="postboxcontainer">
                        <div class="wrapper">
                            <section class="post">
                                <button class="close-btn" id="closeModalBtn">&times;</button>
                                <header>Create Post</header>
                                <form id="addPostForm">
                                <input type="hidden" id="user_id" name="user_id">
                                    <div class="content">
                                        <img src="pics/user.jpg" alt="">
                                        <div class="details">
                                            <p id="postCardName"></p>
                                            <div class="privacy">
                                                <i class="fas fa-user-friends"></i>
                                                <span>Followers</span>
                                                <i class="fas fa-caret-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea placeholder="What's on your mind, <?=$user['firstname']?> <?=$user['lastname']?>" spellcheck="false" required name="caption"></textarea>
                                    <div class="options">
                                        <p>Add to your post</p>
                                        <ul class="list">
                                            <li><img id="uploadImg" src="pics/gallery.png" alt=""></li>
                                            <input type="file" id="picture" name="picture" style="display: none;">
                                        </ul>
                                    </div>
                                    <button>Post</button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="modal" id="updatePostModal">
                    <div class="postboxcontainer">
                        <div class="wrapper">
                            <section class="post">
                                <button class="close-btn" id="closeUpdateModalBtn">&times;</button>
                                <header>Update Post</header>
                                <form id="updatePostForm">
                                    <input type="hidden" id="post_id" name="post_id">
                                    <div class="content">
                                        <img src="pics/user.jpg" alt="">
                                        <div class="details">
                                            <p id="postCardName"></p>
                                            <div class="privacy">
                                                <i class="fas fa-user-friends"></i>
                                                <span>Followers</span>
                                                <i class="fas fa-caret-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea id="caption" placeholder="Update your post" spellcheck="false" required name="caption"></textarea>
                                    <div class="options">
                                        <p>Change image</p>
                                        <ul class="list">
                                            <li><img id="uploadUpdateImgUnavailable" src="pics/unavailable.png" alt=""></li>
                                            <li><img id="uploadUpdateImg" src="pics/gallery.png" alt=""></li>
                                            <input type="file" id="updatePicture" name="picture" style="display: none;">
                                        </ul>
                                    </div>
                                    <button>Update</button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="postcard">
                    <div class="content">
                        <img src="pics/user.jpg" alt="">
                        <textarea id="openModalBtn" placeholder="What's on your mind, <?=$user['firstname']?> <?=$user['lastname']?>" spellcheck="false" title="Create post"></textarea>
                    </div>
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
                        <i class="cardEdit bx bxs-edit"></i>
                        <span class="cardClose">&times;</span>
                    </div>
                    <h4 class="message">
                    </h4>
                    <div class="imgBg postImage">
                        <img src="" alt="" class="cover">
                    </div>
                    <div class="btns">
                        <div class="left">
                            <img src="pics/heart.png" alt="" class="heart" onclick="likeButton()">
                            <img src="pics/comment.png" alt="" class="comment" onclick="commentButton()">
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
                            <input type="hidden" name="user_id" id="user_id" value="">
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



        <aside class="friends-list">
            <div class="listcontainer">
                <h3>Friends List</h3>
                <ul id="friendsList">
                    <li>
                        <img src="pics/user.jpg" alt="Profile Picture">
                        <div class="friend-details">
                            <h4>Ricky Monsales</h4>
                            <span class="suggested">Friend</span>
                        </div>
                        <button class="following-btn">Following</button>
                    </li>
                    <li>
                        <img src="pics/user.jpg" alt="Profile Picture">
                        <div class="friend-details">
                            <h4>Liza Soberano</h4>
                            <span class="suggested">Friend</span>
                        </div>
                        <button class="following-btn">Following</button>
                    </li>
                </ul>
            </div>
            <div class="listcontainer1">
                <h3>Suggested for you</h3>
                <ul id="friendsList">
                    <li>
                        <img src="pics/user.jpg" alt="Profile Picture">
                        <div class="friend-details">
                            <h4>Sung Jin Woo</h4>
                            <span class="suggested">Suggested for you</span>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </li>
                    <li>
                        <img src="pics/user.jpg" alt="Profile Picture">
                        <div class="friend-details">
                            <h4>Kafka Hibino</h4>
                            <span class="suggested">Suggested for you</span>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </li>
                    <li>
                        <img src="pics/user.jpg" alt="Profile Picture">
                        <div class="friend-details">
                            <h4>Roronoa Zoro</h4>
                            <span class="suggested">Suggested for you</span>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="home.js"></script>
</body>
</html>
