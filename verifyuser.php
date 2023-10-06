<?php
include 'db.php';

try {

    function verificarDisponibilidadeUsuario($connection, $nomeUsuario) {
        $sql = "SELECT nome_usuario FROM cadastro WHERE nome_usuario = :nomeUsuario";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() === 0;
    }

    // Rota para verificar a disponibilidade do nome de usuário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"), true);
        $nomeUsuario = $data['nome_usuario'];
        $disponivel = verificarDisponibilidadeUsuario($connection, $nomeUsuario);

        echo json_encode(['disponivel' => $disponivel]);

    }
    } catch (PDOException $e) {
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
?>
