<?php

class Category
{
    // DB Stuff
    private $conn;
    private $table = 'category';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor With DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get (Read) Categories
    public function read()
    {
        // Make Query
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        // Prepare Statment
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
    }
}
