<?php
session_start();

if (isset($_SESSION['USER'])) {
    $user = $_SESSION['USER'];
} else {
    echo json_encode(['error' => 'User not logged in']);
    exit(); 
}

include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Query to count followers
    $sqlFollowerCount = "SELECT COUNT(*) AS followerCount FROM follow WHERE following_id = ?";
    $stmtFollowerCount = $con->prepare($sqlFollowerCount);
    if (!$stmtFollowerCount) {
        echo json_encode(['error' => 'Failed to prepare follower count statement']);
        exit();
    }
    $stmtFollowerCount->execute([$userId]);
    $followerCount = $stmtFollowerCount->fetch(PDO::FETCH_ASSOC)['followerCount'];

    // Query to count following
    $sqlFollowingCount = "SELECT COUNT(*) AS followingCount FROM follow WHERE follower_id = ?";
    $stmtFollowingCount = $con->prepare($sqlFollowingCount);
    if (!$stmtFollowingCount) {
        echo json_encode(['error' => 'Failed to prepare following count statement']);
        exit();
    }
    $stmtFollowingCount->execute([$userId]);
    $followingCount = $stmtFollowingCount->fetch(PDO::FETCH_ASSOC)['followingCount'];

    echo json_encode(['followerCount' => $followerCount, 'followingCount' => $followingCount]);
} else {
    echo json_encode(['error' => 'User ID not provided']);
}
?>
