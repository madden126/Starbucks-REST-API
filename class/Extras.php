<?php
class Extras
{
    // DB
    private $conn;
    private $table = 'extras';

    // Categories Properties
    public $id;
    public $name;
    public $price;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get extra Price
    public function getInfo()
    {
        //query
        $query = "SELECT *
          FROM {$this->table} prod
          where prod.name LIKE '{$this->name}'";

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->price = $row['price'];
    }
}
