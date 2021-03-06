<?php
  class Category {
    // DB Stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT 
        c.id,
        c.name,
        c.created_at
      FROM
        ' . $this->table . ' c
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function read_single() {
      // Create query
      $query = 'SELECT 
       id,
       name
      FROM
        ' . $this->table . '
       WHERE
        id = ?
          LIMIT 0,1';




     // Prepare statement
     $stmt = $this->conn->prepare($query);

     // Bind ID
     $stmt->bindParam(1, $this->id);

     // Execute query
     $stmt->execute();

     $row = $stmt->fetch(PDO::FETCH_ASSOC);

     // Set properties
     $this->id = $row['id'];
     $this->name = $row['name'];
   }
  }