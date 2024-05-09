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

$isFollowing = false;

if (isset($_GET['user_id'])) {
    $following_id = $_GET['user_id'];

    $sql = "SELECT COUNT(*) AS is_following FROM follow WHERE follower_id = ? AND following_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$user['user_id'], $following_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $isFollowing = ($result['is_following'] > 0);
}

echo json_encode(['isFollowing' => $isFollowing]);
?>
