<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Origin,X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();
// Instantiate Category Object
$category = new Category($db);
// Prepare Data
$data = json_decode(file_get_contents("php://input"));
// Prepare Properties
$category->id   = $data->id;
$category->name = $data->name;

// Update Category
if ($category->update()) {
    echo json_encode([
        "message"   => "Category Updated"
    ]);
} else {
    echo json_encode([
        "message"   => "Category Not Updated"
    ]);
}
