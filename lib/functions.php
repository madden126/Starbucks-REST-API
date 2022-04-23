<?php

/**
 * Valida se o numero introduzido está no formato válido (se é maior do que 0, se é numerico e se tem no maximo 2 casas decimais)
 * @param float $cash - quantidade e avaliar
 */
function validateIfMoneyIsLegit($cash)
{
    if ($cash < 0 || !is_numeric($cash) || preg_match('/\.\d{3,}/', $cash)) {
        outputMessage("Money in incorrect format");
        exit;
    }
}


/**
 * Faz output de uma mensagem em formato de json
 * @param string $message
 */
function outputMessage($message)
{
    echo json_encode(
        array('message' => $message)
    );
}

/**
 * Calculo do troco a dar ao cliente
 * float $price - preço final do pedido
 * float $cash - quantia de dinheiro usado para pagar
 * 
 * @return float $change - troco final
 */
function getChange($price, $cash)
{
    $change = 0;
    if ($cash > $price) {
        $change = round($cash - $price, 2);
    }
    return $change;
}
