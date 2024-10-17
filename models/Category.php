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

    public function create()
    {
        // Make Query
        $query = "INSERT INTO $this->table SET name=:name, created_at=now()";
        // Prepare Statment
        $stmt = $this->conn->prepare($query);
        // Prepare Properties Values
        $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
        // Execute Statmt
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        // Make Query
        $query = "UPDATE $this->table SET name=:name WHERE id=:id";
        // Prepare Statment
        $stmt = $this->conn->prepare($query);
        // Bind Properties Value
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $this->name, PDO::PARAM_STR);
        // Execute Statment
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        // Make Query
        $query = "DELETE FROM $this->table WHERE id=:id";
        // Prepare Statment
        $stmt = $this->conn->prepare($query);
        // Bind Properties
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        // Execute Statment
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
