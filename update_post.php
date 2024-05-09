<?php
session_start();

if (!isset($_SESSION['USER'])) {
    echo 'User not logged in';
    exit(); 
}

include 'connection.php';

$user_id = $_SESSION['USER']['user_id'];
$post_id = $_POST['post_id'] ?? '';
$caption = $_POST['caption'] ?? '';

$picture = '';
$unavailableBtnClicked = $_POST['unavailable_btn_clicked'] ?? false; 

if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK && $unavailableBtnClicked) {
    $fileTmpPath = $_FILES['picture']['tmp_name'];
    $fileName = $_FILES['picture']['name'];
    $fileSize = $_FILES['picture']['size'];
    $fileType = $_FILES['picture']['type'];

    $uploadDirectory = 'pics/';

    $picture = $uploadDirectory . uniqid('post_') . '_' . $fileName;

    if(move_uploaded_file($fileTmpPath, $picture)) {
    } else {
        echo 'Error uploading picture. Please try again.';
        exit();
    }
}

try {
    $connection = new Connection();
    $con = $connection->openConnection();

    // Check if a new picture has been uploaded and the unavailable button was clicked
    if (!empty($picture)) {
        // Update both caption and picture
        $stmt = $con->prepare("UPDATE post SET caption = :caption, picture = :picture WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->bindParam(':picture', $picture);
    } else if (empty($picture) && $unavailableBtnClicked == 'true') {
        // Update both caption and picture
        $stmt = $con->prepare("UPDATE post SET caption = :caption, picture = :picture WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->bindParam(':picture', $picture);
    } else {
        // Only update the caption
        $stmt = $con->prepare("UPDATE post SET caption = :caption WHERE post_id = :post_id AND user_id = :user_id");
    }

    // Bind parameters
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':caption', $caption);

    // Execute the statement
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'Post updated successfully';
    } else {
        echo 'Error updating post. Please try again later.';
    }

    // Close connection
    $con = null;
} catch (Exception $e) {
    echo 'Error updating post: ' . $e->getMessage();
}
?>
