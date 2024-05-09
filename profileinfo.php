<?php
session_start();
include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

if ($con) {
    if (isset($_SESSION['USER']) && $_SESSION['LOGGED_IN'] === true) {
        $userId = $_SESSION['USER']['user_id']; 
        
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
        echo json_encode(['error' => 'User not logged in']);
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
