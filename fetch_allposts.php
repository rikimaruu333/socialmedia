<?php
session_start();

include 'connection.php';

try {
    $connection = new Connection();
    $con = $connection->openConnection();

    // Get the current user's ID
    $currentUserID = $_SESSION['USER']['user_id'];

    $postStmt = $con->prepare("SELECT p.*, u.firstname, u.lastname, u.nickname, u.profile, COUNT(c.comment_id) AS total_comments 
                                FROM post p 
                                LEFT JOIN users u ON p.user_id = u.user_id 
                                LEFT JOIN comments c ON p.post_id = c.post_id 
                                WHERE p.user_id = :currentUserID OR p.user_id IN 
                                    (SELECT following_id FROM follow WHERE follower_id = :currentUserID)
                                GROUP BY p.post_id 
                                ORDER BY p.post_created DESC");

    // Bind the current user's ID parameter
    $postStmt->bindParam(':currentUserID', $currentUserID, PDO::PARAM_INT);
    $postStmt->execute();

    $posts = $postStmt->fetchAll(PDO::FETCH_ASSOC);

    // Add current user's ID to each post for comparison
    foreach ($posts as &$post) {
        $post['currentUserID'] = $currentUserID;
    }

    echo json_encode($posts);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
}
?>
