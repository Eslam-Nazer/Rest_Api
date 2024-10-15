<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate post object
$post = new Post($db);

// Get Id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Post (a single post)
$post->read_single();

$post_arr = [
    'id'                => $post->id,
    'title'             => $post->title,
    'body'              => $post->body,
    'author'            => $post->author,
    'category_name'     => $post->category_name,
    'category_id'       => $post->category_id,
];

// Make It JSON
print_r(json_encode($post_arr));
