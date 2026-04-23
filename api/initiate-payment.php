<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(E_ALL);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

$apiKey = 'MGPYlWU6lMpS';
$email = 'denniskoskey5@gmail.com';

function respond_json($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if (!$input) {
    respond_json(400, [
        'success' => false,
        'message' => 'Invalid JSON payload received.',
        'raw' => $rawInput
    ]);
}

if (empty($input['msisdn']) || empty($input['amount']) || empty($input['reference'])) {
    respond_json(400, [
        'success' => false,
        'message' => 'Missing required fields.'
    ]);
}

$payload = [
    'api_key' => $apiKey,
    'email' => $email,
    'amount' => (int)$input['amount'],
    'msisdn' => $input['msisdn'],
    'reference' => $input['reference']
];

$ch = curl_init('https://megapay.co.ke/backend/v1/initiatestk');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    respond_json(500, [
        'success' => false,
        'message' => 'cURL error: ' . $curlError
    ]);
}

if ($response === false || $response === '') {
    respond_json(500, [
        'success' => false,
        'message' => 'Empty response from MegaPay.'
    ]);
}

$decoded = json_decode($response, true);

if ($httpCode >= 200 && $httpCode < 300) {
    respond_json(200, [
        'success' => true,
        'message' => $decoded['message'] ?? 'STK push initiated successfully.',
        'data' => $decoded
    ]);
}

respond_json($httpCode ?: 500, [
    'success' => false,
    'message' => $decoded['message'] ?? 'MegaPay request failed.',
    'data' => $decoded
]);
