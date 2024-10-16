<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Cotent-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Category Object
$category = new Category($db);

// Get id
$category->id = isset($_GET["id"]) ? $_GET["id"] : die();

// Get Category (one category)
$category->read_one();

$category_arr = [
    "id"            => $category->id,
    "name"          => $category->name,
    "created_at"    => $category->created_at,
];

print_r(json_encode($category_arr));
