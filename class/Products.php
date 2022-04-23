<?php
class Products
{
    // DB
    private $conn;
    private $table = 'products';

    // Products Properties
    public $id;
    public $name;
    public $price;
    public $stock;
    public $idCategory;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // GET ALL
    public function getAll()
    {
        $query = "SELECT prod.id, prod.name, prod.price, prod.stock, prod.idCategory, categories.name as nameCategory
        FROM {$this->table} prod
        LEFT JOIN categories
        ON prod.idCategory = categories.id
        ORDER by prod.idCategory asc;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get product info
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
        $this->stock = $row['stock'];
        $this->idCategory = $row['idCategory'];
    }
}
