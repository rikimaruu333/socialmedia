<?php
include 'connection.php';

session_start();

try {
    $connection = new Connection();
    $con = $connection->openConnection();

    $userId = $_SESSION['USER']['user_id'];

    $postStmt = $con->prepare("
        SELECT post.*, 
            (SELECT COUNT(*) FROM comments WHERE comments.post_id = post.post_id) AS comment_count
        FROM post 
        WHERE user_id = ? 
        ORDER BY post_created DESC
    ");

    $postStmt->execute([$userId]);
    $posts = $postStmt->fetchAll(PDO::FETCH_ASSOC);

    $userStmt = $con->query("SELECT * FROM users");
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

    $postsWithPic = [];
    $postsWithoutPic = [];

    foreach ($posts as $post) {
        $userData = array_filter($users, function ($user) use ($userId) {
            return $user['user_id'] == $userId;
        });

        $combinedData = array_merge($post, reset($userData));

        if (!empty($post['picture'])) {
            $postsWithPic[] = $combinedData;
        } else {
            $postsWithoutPic[] = $combinedData;
        }
    }

    $totalPosts = count($posts);

    echo json_encode(['postsWithPic' => $postsWithPic, 'postsWithoutPic' => $postsWithoutPic, 'totalPosts' => $totalPosts]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
}
?>
