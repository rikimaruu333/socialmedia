<?php
include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

if ($con) {
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id']; 
        
        $userData = getUserData($userId, $con);

        if ($userData) {
            header('Content-Type: application/json');
            echo json_encode($userData);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'User data not found']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'User ID not provided']);
    }

    $connection->closeConnection();
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database connection error']);
}

function getUserData($userId, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}
?>
