<?php
include 'db.php';

try {

    function newPassword($connection, $nomeUsuario, $senha) {
        $sql = "UPDATE cadastro SET senha = :senha WHERE nome_usuario = :nomeUsuario";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Rota para verificar a disponibilidade do nome de usuário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"), true);
        $nomeUsuario = $data['nomeUsuario'];
        $senha = $data['senha'];
        newPassword($connection, $nomeUsuario, $senha);

        echo json_encode(['update' => true]);

    }
    } catch (PDOException $e) {
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
?>
