<?php
session_start();
include 'connection.php';

if(isset($_POST['post_id']) && !empty($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    try {
        $connection = new Connection();
        $con = $connection->openConnection();

        $commentStmt = $con->prepare("SELECT comments.*, users.profile, users.firstname, users.lastname, users.nickname FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.post_id = ? ORDER BY comments.comment_date DESC");
        $commentStmt->execute([$postId]);
        $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

        $currentUserID = $_SESSION['USER']['user_id'];
        foreach ($comments as &$comment) {
            $comment['currentUserID'] = $currentUserID;
        }

        echo json_encode(['comments' => $comments]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error fetching comments: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Post ID is required']);
}
?>
