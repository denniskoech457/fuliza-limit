<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(E_ALL);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

$apiKey = 'MGPYlWU6lMpS';
$email = 'denniskoskey5@gmail.com';

if (!$input) {
    http_response_code(400);
    echo json_encode([
        'message' => 'Invalid JSON payload received by backend.',
        'raw' => $rawInput
    ]);
    exit;
}

if (empty($input['msisdn']) || empty($input['amount']) || empty($input['reference'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing required fields.']);
    exit;
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
    http_response_code(500);
    echo json_encode(['message' => 'cURL error: ' . $curlError]);
    exit;
}

if ($response === false || $response === '') {
    http_response_code(500);
    echo json_encode(['message' => 'Empty response from MegaPay.']);
    exit;
}

$decoded = json_decode($response, true);

if ($httpCode >= 200 && $httpCode < 300) {
    echo json_encode([
        'success' => true,
        'message' => $decoded['message'] ?? 'STK push initiated successfully.',
        'data' => $decoded
    ]);
} else {
    http_response_code($httpCode ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $decoded['message'] ??
