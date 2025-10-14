<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$file = __DIR__ . '/posts.json';
$data = json_decode(file_get_contents('php://input'), true);

// Garante que o arquivo exista
if (!file_exists($file)) {
    file_put_contents($file, '[]');
}

$posts = json_decode(file_get_contents($file), true);
if (!is_array($posts)) $posts = [];

$updated = false;

// Procura o post e atualiza
foreach ($posts as &$post) {
    if ($post['id'] === $data['id']) {
        $post = array_merge($post, $data);
        $updated = true;
        break;
    }
}

if ($updated) {
    file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(['success' => true, 'message' => 'Post atualizado com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Post não encontrado.']);
}
?>
