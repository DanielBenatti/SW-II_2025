<?php
    header("Content-Type: application/json; charset=UTF-8"); 

    $metodo = $_SERVER['REQUEST_METHOD'];
    $arquivo = 'usuario.json';


    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }


    $usuarios = json_decode(file_get_contents($arquivo), true);

    switch ($metodo) {
        case 'GET':
            if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $usuario_encontrado = null;
                

                foreach ($usuarios as $usuario) {
                    if ($usuario['id'] == $id) {
                        $usuario_encontrado = $usuario;
                        break;
                    }
                }


                if ($usuario_encontrado) {
                    echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                } else {
                    http_response_code(404);
                    echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
            break;
        case 'POST':
            $dados = json_decode(file_get_contents('php://input'),true);

            if (!isset($dados["nome"]) || !isset($dados["email"])) {
                http_response_code(400);
                echo json_encode(["erro" => "Nome e email são obrigatórios."], JSON_UNESCAPED_UNICODE);
                exit;
            }

            $novo_id = 1;
            if (!empty($usuarios)) {
                $ids = array_column($usuarios, 'id');
                $novo_id = mas($ids) + 1;
            }

            $novo_usuario = [
                "id" => $novo_id,
                "nome" => $dados["nome"],
                "email" => $dados["email"],
            ];

            $usuarios[] = $novo_usuario;
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuário inserido com sucesso!", "usuarios" => $novo_usuario], JSON_UNESCAPED_UNICODE);
            break;
            
        default:
            http_response_code(405); // Método não permitido!
            echo json_encode(["erro" => "Método não permitido!"], JSON_UNESCAPED_UNICODE);
            break;
    }    
?>