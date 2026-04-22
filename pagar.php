<?php
// Configuración de cabeceras para que el HTML pueda leer la respuesta
header('Content-Type: application/json');

// --- AQUÍ PEGAS TU ACCESS TOKEN ---
$access_token = "APP_USR-8613680816943209-042201-ed01e7a10a7043db37c58412e3b7f708-2924234776"; 

// Recibimos los datos del formulario de la tienda
$monto = isset($_POST['monto']) ? $_POST['monto'] : 0;
$id_jugador = isset($_POST['player_id']) ? $_POST['player_id'] : 'Sin ID';

// Estructura de la petición para OXXO Pay
$data = [
    "transaction_amount" => (float)$monto,
    "description" => "Recarga Diamantes - ID: " . $id_jugador,
    "payment_method_id" => "oxxo",
    "payer" => [
        "email" => "pago_cliente@diamondstore.com"
    ]
];

$ch = curl_init("https://api.mercadopago.com/v1/payments");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $access_token,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$status = curl_getinfo($ch, http_code: CURLINFO_HTTP_CODE);
curl_close($ch);

// Enviamos la respuesta de Mercado Pago a tu página
echo $response;
?>