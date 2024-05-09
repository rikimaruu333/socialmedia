<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve data from the POST request
        $comment_id = $_POST['comment_id'];
        $comment_content = $_POST['comment_content'];

        // Update the comment in the database
        $connection = new Connection();
        $con = $connection->openConnection();

        $stmt = $con->prepare("UPDATE comments SET comment_content = ? WHERE comment_id = ?");
        $stmt->execute([$comment_content, $comment_id]);

        if ($stmt->rowCount() > 0) {
            // If the comment is updated successfully
            echo json_encode(['success' => true]);
        } else {
            // If the comment is not found or could not be updated
            echo json_encode(['success' => false, 'error' => 'Comment not found or could not be updated']);
        }
    } catch (Exception $e) {
        // If an error occurs during the process
        echo json_encode(['success' => false, 'error' => 'Error updating comment: ' . $e->getMessage()]);
    }
} else {
    // If the request method is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
