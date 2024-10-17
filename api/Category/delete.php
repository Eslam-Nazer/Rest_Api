<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,X-Requested-With");

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
$category->id = $data->id;

// Delete Category
if ($category->delete()) {
    echo json_encode([
        "message"   => "Category Deleted"
    ]);
} else {
    echo json_encode([
        "message"   => "Category Not Deleted"
    ]);
}
