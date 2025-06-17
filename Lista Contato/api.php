<?php
header("Content-Type: application/json");

// Caminho do arquivo JSON
$dataFile = 'data.json';

// Carrega os dados
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Função para salvar os dados no JSON
function saveData($dataFile, $data) {
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
}

// Captura o método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// ID opcional (em requisições que usam query string ou corpo)
$id = $_GET['id'] ?? null;

// Lê o corpo da requisição (JSON)
$body = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        // Retorna todos ou um contato específico
        if ($id !== null) {
            foreach ($data as $contato) {
                if ($contato['id'] == $id) {
                    echo json_encode($contato);
                    exit;
                }
            }
            http_response_code(404);
            echo json_encode(["erro" => "Contato não encontrado"]);
        } else {
            echo json_encode($data);
        }
        break;

    case 'POST':
        // Cria um novo contato
        if (!$body || !isset($body['nome']) || !isset($body['email'])) {
            http_response_code(400);
            echo json_encode(["erro" => "Dados inválidos"]);
            exit;
        }

        $novoContato = [
            "id" => time(),
            "nome" => $body['nome'],
            "email" => $body['email']
        ];
        $data[] = $novoContato;
        saveData($dataFile, $data);
        echo json_encode($novoContato);
        break;

    case 'PUT':
        // Atualiza um contato existente
        if ($id === null || !$body) {
            http_response_code(400);
            echo json_encode(["erro" => "ID e dados obrigatórios"]);
            exit;
        }

        $atualizado = false;
        foreach ($data as &$contato) {
            if ($contato['id'] == $id) {
                $contato['nome'] = $body['nome'] ?? $contato['nome'];
                $contato['email'] = $body['email'] ?? $contato['email'];
                $atualizado = true;
                break;
            }
        }

        if ($atualizado) {
            saveData($dataFile, $data);
            echo json_encode(["mensagem" => "Contato atualizado com sucesso"]);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Contato não encontrado"]);
        }
        break;

    case 'DELETE':
        // Deleta um contato
        if ($id === null) {
            http_response_code(400);
            echo json_encode(["erro" => "ID obrigatório"]);
            exit;
        }

        $novoArray = array_filter($data, fn($c) => $c['id'] != $id);

        if (count($novoArray) !== count($data)) {
            saveData($dataFile, array_values($novoArray));
            echo json_encode(["mensagem" => "Contato deletado com sucesso"]);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Contato não encontrado"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido"]);
}
