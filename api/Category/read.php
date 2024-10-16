<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Access-Control-Allow-Origin,Content-Type,X-Requested-With");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();
// Instantaite Category Object
$category = new Category($db);

// Category read query
$result = $category->read();
$num = $result->rowCount();
// Check if any Categories
if ($num > 0) {
    // Category Array
    $category_arr = [
        'data'  => []
    ];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_items = [
            "id"    => $id,
            "name"  => $name,
        ];
        // Push to "data"
        array_push($category_arr["data"], $category_items);
    }
    // Trun to JSON
    echo  json_encode($category_arr);
} else {
    // No Categories
    echo json_encode([
        "message"   => "No Categories Found"
    ]);
}
