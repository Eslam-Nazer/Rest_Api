<?php
// Headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Post Object
$post = new Post($db);

//Post Query
$result = $post->read();
// Get row count
$num = $result->rowCount();

// Check if any posts
if ($num > 0) {
    // Post array
    $posts_arr = [
        'data'  => [],
    ];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = [
            'id'            => $id,
            'title'         => $title,
            'body'          => html_entity_decode($body),
            'author'        => $author,
            'category_id'   => $category_id,
            'category_nane' => $category_name,
        ];

        // Push to "data"
        array_push($posts_arr['data'], $post_item);
    }

    // Turn to json output
    echo json_encode($posts_arr);
} else {
    // No Posts
    echo json_encode([
        "message" => "No Posts Found"
    ]);
}
