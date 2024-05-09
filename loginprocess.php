<?php
session_start();

include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

$email = $_POST["email"];
$password = $_POST["password"];

if ($con) {
    try {
        $stmt = $con->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['USER'] = $user; // Store user data in session
                $_SESSION['LOGGED_IN'] = true;
                echo "success";
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $connection->closeConnection();
} else {
    echo "Error: Unable to establish a database connection";
}
?>
