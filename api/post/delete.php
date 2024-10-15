<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Content-type: application/json");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Content-Type,X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Intantiate Post Object
$post = new Post($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

// Delete Post
if ($post->delete()) {
    echo json_encode([
        "message"   => "Post Deleted"
    ]);
} else {
    echo json_encode([
        "message"   => "Post Not Deleted"
    ]);
}
