<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    try {
        if (isset($_POST['post_id'])) {
            $post_id = $_POST['post_id'];

            $connection = new Connection();
            $con = $connection->openConnection();

            $stmt = $con->prepare("DELETE FROM post WHERE post_id = ?");
            $stmt->execute([$post_id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Post deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Post not found or could not be deleted']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Post ID is required']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Error deleting post: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
