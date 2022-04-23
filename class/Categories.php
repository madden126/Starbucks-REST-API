<?php
class Categories
{
    // DB
    private $conn;
    private $table = 'categories';

    // Categories Properties
    public $id;
    public $name;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
}
