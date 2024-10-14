<?php

class Post
{
    // DB stuff
    private $conn;
    private $table = "posts";

    // Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function read()
    {
        // Make Query
        $query  = "SELECT P.*, C.name AS category_name FROM " . $this->table . " P";
        $query .= " INNER JOIN category C ON P.category_id = C.id ORDER BY P.created_at DESC";

        // Prepare Query
        $stmt = $this->conn->prepare($query);

        // Execute Query
        $stmt->execute();

        return $stmt;
    }
}
