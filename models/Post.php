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

    // Get Single Post
    public function read_single()
    {
        $query  = "SELECT P.*, C.name AS category_name FROM " . $this->table . " P";
        $query .= " INNER JOIN category C ON P.category_id = C.id ";
        $query .= " WHERE P.id= :id LIMIT 1";

        // Prepare Statment
        $stmt = $this->conn->prepare($query);

        // Bind Id
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);

        // Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->title = $row['title'];
        $this->category_id = $row['category_id'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_name = $row['category_name'];
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET title=:title, body=:body, author=:author, category_id=:category_id';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Filtration data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind data
        $params = [
            ":title"    => $this->title,
            ":body"    => $this->body,
            ":author"    => $this->author,
            ":category_id"    => $this->category_id,
        ];

        if ($stmt->execute($params)) {
            return true;
        }

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);
        return false;
    }
}
