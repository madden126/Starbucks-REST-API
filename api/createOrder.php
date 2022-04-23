<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../class/Products.php';
include_once '../class/Extras.php';
include_once '../lib/functions.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$product = new Products($db);
$extras = new Extras($db);

//ir buscar o pedido ao json introduzido
$data = json_decode(file_get_contents("php://input"));

if (empty($data->product)) {
    outputMessage("No product name selected");
    exit();
}

$product->name = $data->product;
$product->getInfo();

if (empty($product->id)) { //validar se o produto selecionado existe
    outputMessage("No product found with name '{$data->product}'");
    exit();
}

if (empty($product->stock) || $product->stock < 0) { //validar stock do produto
    outputMessage("Unfortunately '{$data->product}' is out of stock, please select another product");
    exit();
}


if (!empty($data->extras)) { //extras
    $finalPrice = 0;

    $extrasList = $data->extras;

    foreach ($extrasList as $values) {
        $extras->name = $values;
        $extras->getInfo();

        $finalPrice += $extras->price;
    }

    $finalPrice += $product->price;
} else {
    $finalPrice = $product->price;
}



if (empty($data->money)) {
    outputMessage("Dont forget to pay, the final price will be {$finalPrice}€");
    exit();
}

//check if argument "money" is correct
validateIfMoneyIsLegit($data->money);

if ($data->money < $finalPrice) {
    $finalMessage = "Insufficient funds";
    $change = 0;
} else {
    $change = getChange($finalPrice, $data->money);
    $finalMessage = "Order completed with success";
}

echo json_encode(
    array(
        'message' => $finalMessage,
        'total' => "{$finalPrice}€",
        'change' => "{$change}€",
    )
);
