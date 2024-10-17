<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Header,Access-Control-Allow-Methods,Access-Control-Allow-Origin,Content-Type,X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate Catefory object
$category = new Category($db);

// Prepare Data
$data = json_decode(file_get_contents("php://input"));

// Prepare Properties
$category->name = $data->name;


// Create Category
if ($category->create()) {
    echo json_encode([
        "message"   => "Category Created"
    ]);
} else {
    echo json_encode([
        "message"   => "Category Not Created"
    ]);
}
