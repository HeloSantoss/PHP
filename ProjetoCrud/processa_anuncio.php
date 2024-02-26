<?php
require_once 'conectaBD.php';
session_start();

if (empty($_SESSION)) {
    // Significa que as variáveis de SESSAO não foram definidas.
    // Não poderia acessar aqui.
    header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
    die();
}

if (!empty($_POST)) {
    // Está chegando dados por POST e então posso tentar inserir no banco
    // Obter as informações do formulário ($_POST)
    // Verificar se estou tentando INSERIR (CAD) /
    if ($_POST['enviarDados'] == 'CAD') { // CADASTRAR!!!
        try {
            // Montar a SQL (pgsql)
            $sql = "INSERT INTO anuncio (fase, tipo, porte, sexo, pelagem_cor, raca, observacao, email_usuario)
                    VALUES (:fase, :tipo, :porte, :sexo, :pelagem_cor, :raca, :observacao, :email_usuario)";
            
            // Preparar a SQL (pdo)
            $stmt = $pdo->prepare($sql);
            
            // Definir/organizar os dados p/ SQL
            $dados = array(
                ':fase' => $_POST['fase'],
                ':tipo' => $_POST['tipo'],
                ':porte' => $_POST['porte'],
                ':sexo' => $_POST['sexo'],
                ':pelagem_cor' => $_POST['pelagemCor'],
                ':raca' => $_POST['raca'],
                ':observacao' => $_POST['observacao'],
                ':email_usuario' => $_SESSION['email']
            );
            
            // Tentar Executar a SQL (INSERT)
            if ($stmt->execute($dados)) {
                header("Location: index_logado.php?msgSucesso=Anúncio cadastrado com sucesso!");
                exit(); // Termina o script após o redirecionamento
            }
        } catch (PDOException $e) {
            header("Location: index_logado.php?msgErro=Falha ao cadastrar anúncio..");
            die($e->getMessage());
        }
    } else {
        header("Location: index_logado.php?msgErro=Erro de acesso (Operação não definida).");
        exit();
    }
} else {
    header("Location: index_logado.php?msgErro=Erro de acesso.");
    exit();
}
?>
