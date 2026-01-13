<?php
header('Content-Type: application/json');

// ==========================================
// 🔐 BAGIAN 1: LOAD TOKEN (Punya Teman - AMAN)
// ==========================================

// Load TOKEN dari .env file (biar aman dan gak hardcode)
$envPath = __DIR__ . '/../.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) continue;
        
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Ambil token dari environment variable
$HF_TOKEN = $_ENV['HF_TOKEN'] ?? '';

// Cek keamanan: Kalau token kosong, kasih tau error
if (empty($HF_TOKEN)) {
    echo json_encode(["summary" => "Error: HF_TOKEN tidak ditemukan di file .env"]);
    exit;
}

// ==========================================
// 🧠 BAGIAN 2: LOGIKA AI (Punya Kamu/Standar)
// ==========================================

// 📝 Ambil text
$text = trim($_POST['text'] ?? '');

if (strlen($text) < 30) {
    echo json_encode([
        "summary" => "Teks terlalu pendek untuk diringkas."
    ]);
    exit;
}

// 📦 Data ke AI
$data = [
    "inputs" => $text,
    "parameters" => [
        "max_length" => 120,
        "min_length" => 40,
        "do_sample" => false
    ]
];

// 🔥 REQUEST KE facebook/bart-large-cnn
$ch = curl_init("https://router.huggingface.co/hf-inference/models/facebook/bart-large-cnn");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $HF_TOKEN,
        "Content-Type: application/json"
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 🧪 Decode response
$result = json_decode($response, true);

// ❌ HANDLE ERROR
if ($httpCode !== 200) {
    echo json_encode([
        "summary" => "AI error ($httpCode): " . ($result['error'] ?? 'Unknown error')
    ]);
    exit;
}

// ✅ OUTPUT NORMAL
if (isset($result[0]['summary_text'])) {
    echo json_encode([
        "summary" => trim($result[0]['summary_text'])
    ]);
} else {
    echo json_encode([
        "summary" => "AI tidak menghasilkan ringkasan."
    ]);
}
?>

