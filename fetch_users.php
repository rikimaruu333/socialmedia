<?php
session_start();

if (isset($_SESSION['USER'])) {
    include 'connection.php';

    $connection = new Connection();
    $conn = $connection->openConnection();

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $userData = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['user_id'] !== $_SESSION['USER']['user_id']) { // Exclude the currently logged-in user
            $userData[] = array(
                'user_id' => $row['user_id'],
                'nickname' => $row['nickname'],
                'real_name' => $row['firstname'] . ' ' . $row['lastname'],
                'profile' => $row['profile']
            );
        }
    }

    if (!empty($userData)) {
        echo json_encode($userData);
    } else {
        echo json_encode(array('error' => 'No other users found'));
    }

    $conn = null; // Close the connection
} else {
    echo json_encode(array('error' => 'User not logged in'));
}
?>
