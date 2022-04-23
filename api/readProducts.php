<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Products.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$products = new Products($db);
$stmt = $products->getAll();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);
if ($itemCount > 0) {

    $categoryArr = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        if (!isset($categoryArr[$nameCategory])) {
            $categoryArr[$nameCategory] = [];
        }
        $e = array(
            "name" => $name,
            "price" => $price,
            "stock" => $stock,
        );

        array_push($categoryArr[$nameCategory], $e);
    }
    echo json_encode($categoryArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No drinks found.")
    );
}
