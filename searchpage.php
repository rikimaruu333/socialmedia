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
    <link rel="stylesheet" href="searchpage.css">
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
                        <a href="" title="Search">
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
            <div class="searchbox">
                <form class="searchbar">
                    <input type="text" name="search" placeholder="Search users..." autocomplete="off">
                    <button><img src="pics/search.png" alt="" class="search-button"></button>
                </form>
            </div>
            <div class="user-box">
                
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="searchpage.js"></script>
</body>
</html>