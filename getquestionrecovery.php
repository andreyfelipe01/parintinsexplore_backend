<?php
include 'db.php';

try {

    function getQuestion($connection, $nomeUsuario) {
        $sql = "SELECT pergunta_rec.pergunta FROM cadastro, pergunta_rec WHERE cadastro.nome_usuario = :nomeUsuario and pergunta_rec.user_cadastro = cadastro.nome_usuario";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Rota para verificar a disponibilidade do nome de usuário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"), true);
        $nomeUsuario = $data['nomeUsuario'];
        $response = getQuestion($connection, $nomeUsuario);

        echo json_encode($response);

    }
    } catch (PDOException $e) {
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
?>
