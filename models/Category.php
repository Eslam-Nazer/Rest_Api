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

    public function read_one()
    {
        // Make Query
        $query = "SELECT * FROM $this->table WHERE id=:id LIMIT 1";
        // prepare Statmt
        $stmt = $this->conn->prepare($query);
        // Bind id value
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        // Execute Statment
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->id           = $row["id"];
        $this->name         = $row["name"];
        $this->created_at   = $row["created_at"];
    }
}
