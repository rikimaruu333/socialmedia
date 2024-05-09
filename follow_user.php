<?php
session_start();

include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['following_id'])) {
        $following_id = $_POST['following_id'];

        $sql = "INSERT INTO follow (follower_id, following_id) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute([$_SESSION['USER']['user_id'], $following_id]);

        echo json_encode(['success' => 'User followed successfully']);
    } else {
        echo json_encode(['error' => 'Following ID not provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
