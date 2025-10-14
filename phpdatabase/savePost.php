<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$file = __DIR__ . '/posts.json'; // Caminho absoluto
$data = json_decode(file_get_contents('php://input'), true);

// Se o arquivo não existir, cria um vazio
if (!file_exists($file)) {
    file_put_contents($file, '[]');
}

$posts = json_decode(file_get_contents($file), true);
if (!is_array($posts)) $posts = [];

// Se tiver id, atualiza; se não, adiciona
if (isset($data['id'])) {
    foreach ($posts as &$post) {
        if ($post['id'] === $data['id']) {
            $post = $data;
            break;
        }
    }
} else {
    $data['id'] = uniqid();
    $data['created_at'] = date('Y-m-d H:i:s');
    $posts[] = $data;
}

// Salva novamente
file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(['success' => true, 'message' => 'Post salvo com sucesso!']);
?>
