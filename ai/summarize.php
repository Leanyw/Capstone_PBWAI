<?php
header('Content-Type: application/json');

// 🔐 TOKEN HUGGING FACE
$HF_TOKEN = "";

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
