<?php
session_start();

if (!isset($_SESSION['USER'])) {
    echo 'User not logged in';
    exit(); 
}

// Include your database connection file
include 'connection.php';

$user_id = $_SESSION['USER']['user_id'];
$caption = $_POST['caption'] ?? '';

// Handle file upload if a file is selected
$picture = '';
if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['picture']['tmp_name'];
    $fileName = $_FILES['picture']['name'];
    $fileSize = $_FILES['picture']['size'];
    $fileType = $_FILES['picture']['type'];

    // Directory where the file will be stored
    $uploadDirectory = 'pics/';

    // Generate a unique filename to prevent overwriting
    $picture = $uploadDirectory . uniqid('post_') . '_' . $fileName;

    // Move the uploaded file to the desired location
    if(move_uploaded_file($fileTmpPath, $picture)) {
        // File uploaded successfully
    } else {
        echo 'Error uploading picture. Please try again.';
        exit();
    }
}

try {
    // Open connection
    $connection = new Connection();
    $con = $connection->openConnection();

    // Prepare statement
    $stmt = $con->prepare("INSERT INTO post (user_id, caption, picture, post_created) VALUES (:user_id, :caption, :picture, NOW())");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':caption', $caption);
    $stmt->bindParam(':picture', $picture);

    // Execute statement
    $stmt->execute();

    // Check if the post was successfully inserted
    if ($stmt->rowCount() > 0) {
        echo 'Post created successfully';
    } else {
        echo 'Error creating post. Please try again later.';
    }

    // Close connection
    $con = null;
} catch (Exception $e) {
    echo 'Error creating post: ' . $e->getMessage();
}
?>
