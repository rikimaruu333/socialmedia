<?php
session_start();
include('connection.php');

$connection = new Connection();
$con = $connection->openConnection();

if (!isset($_SESSION['USER'])) {
    header("Location: signup.php");
    exit(); 
}

$user_id = $_SESSION['USER']['user_id'];

$nickname = $_POST['nickname'] ?? '';
$first_name = $_POST['firstname'] ?? ''; // Check if the key exists in $_POST, otherwise set a default value
$last_name = $_POST['lastname'] ?? ''; // Check if the key exists in $_POST, otherwise set a default value
$gender = $_POST['gender'] ?? ''; // Check if the key exists in $_POST, otherwise set a default value

$profile_pic_location = ''; // Initialize the variable to avoid undefined variable error

// Check if a file was uploaded
if(isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePic']['tmp_name'];
    $fileName = $_FILES['profilePic']['name'];
    $fileSize = $_FILES['profilePic']['size'];
    $fileType = $_FILES['profilePic']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = "profile_" . $user_id . '.' . $fileExtension;

    // Directory where the file will be stored
    $uploadDirectory = 'pics/';

    // Move the uploaded file to the desired location
    $destPath = $uploadDirectory . $newFileName;
    if(move_uploaded_file($fileTmpPath, $destPath)) {
        $profile_pic_location = $destPath;
    } else {
        echo 'Error uploading profile picture. Please try again.';
        exit();
    }

    // Update the profile in the database with the new profile picture location
    $stmt = $con->prepare("UPDATE users SET nickname = ?, firstname = ?, lastname = ?, gender = ?, profile = ? WHERE user_id = ?");
    $stmt->execute([$nickname, $first_name, $last_name, $gender, $profile_pic_location, $user_id]);
} else {
    // If no new profile picture was uploaded, update other user details without changing the profile picture
    $stmt = $con->prepare("UPDATE users SET nickname = ?, firstname = ?, lastname = ?, gender = ? WHERE user_id = ?");
    $stmt->execute([$nickname, $first_name, $last_name, $gender, $user_id]);
}

if ($stmt->rowCount() > 0) {
    echo 'Profile updated successfully!';
} else {
    echo 'Error updating profile. Please try again later.';
}

$con = null; // Close the PDO connection
?>
