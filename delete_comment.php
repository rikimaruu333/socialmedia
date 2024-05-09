<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    try {
        if (isset($_POST['comment_id'])) {
            $comment_id = $_POST['comment_id'];

            $connection = new Connection();
            $con = $connection->openConnection();

            $stmt = $con->prepare("DELETE FROM comments WHERE comment_id = ?");
            $stmt->execute([$comment_id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Comment deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Comment not found or could not be deleted']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Comment ID is required']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Error deleting comment: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
