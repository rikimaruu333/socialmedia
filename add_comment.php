<?php
session_start();

if (!isset($_SESSION['USER'])) {
    echo json_encode(array('success' => false, 'message' => 'User not logged in'));
    exit();
}

include 'connection.php';

$postId = $_POST['post_id'];
$userId = $_POST['user_id'];
$commentContent = htmlspecialchars($_POST['comment_content']); 

try {
    $connection = new Connection();
    $con = $connection->openConnection();

    $stmt = $con->prepare("INSERT INTO comments (post_id, user_id, comment_content, comment_date) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$postId, $userId, $commentContent]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(array('success' => true, 'message' => 'Comment added successfully'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to add comment'));
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => 'Error adding comment: ' . $e->getMessage()));
}
?>
