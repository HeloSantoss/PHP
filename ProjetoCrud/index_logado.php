<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Página Inicial - Ambiente Logado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container">
<?php if (!empty($_GET['msgErro'])) { ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_GET['msgErro']; ?>
    </div>
<?php } ?>
<?php if (!empty($_GET['msgSucesso'])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['msgSucesso']; ?>
    </div>
<?php } ?>
</div>
<div class="container">
    <div class="col-md-11">
        <h2 class="title">Olá <i><?php echo $_SESSION['nome']; ?></i>, seja bem-vindo(a)!</h2>
    </div>
</div>
<div class="container">
    <a href="cad_anuncio.php" class="btn btn-primary">Novo Anúncio</a>
    <a href="index_logado.php?meus_anuncios=1" class="btn btn-success">Meus Anúncios</a>
    <a href="index_logado.php?meus_anuncios=0" class="btn btn-info">Todos Anúncios</a>
    <a href="logout.php" class="btn btn-dark">Sair</a>
</div>
</body>
</html>

<?php
require_once 'conectaBD.php';
session_start();
if (empty($_SESSION)) {
    // Significa que as variáveis de SESSAO não foram definidas.
    // Não pode acessar aqui. o sistema manda voltar para a pagina de login
    header("Location: index.php?msgErro=Você precisa se autenticar no sistema.");
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Novo Anúncio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Cadastrar Novo Anúncio de Animal para Adoção</h1>
    <form action="processa_anuncio.php" method="post">
        <div class="col-4">
            <label for="fase">Fase</label>
            <select class="form-select" name="fase" id="fase">
                <option selected>Selecione a fase do animal</option>
                <option value="F">Filhote</option>
                <option value="A">Adulto</option>
            </select>
        </div>
        <div class="col-4">
            <label for="tipo">Tipo</label>
            <select class="form-select" name="tipo" id="tipo">
                <option selected>Selecione o tipo do animal</option>
                <option value="G">Gato</option>
                <option value="C">Cachorro</option>
            </select>
        </div>
        <div class="col-4">
            <label for="porte">Porte</label>
            <select class="form-select" name="porte" id="porte">
                <option selected>Selecione o porte do animal</option>
                <option value="P">Pequeno</option>
                <option value="M">Médio</option>
                <option value="G">Grande</option>
            </select>
        </div>
        <div class="col-4">
            <label for="pelagemCor">Pelagem / Cor</label>
            <input type="text" name="pelagemCor" id="pelagemCor" class="form-control">
        </div>
        <div class="col-4">
            <label for="raca">Raça</label>
            <input type="text" name="raca" id="raca" class="form-control">
        </div>
        <div class="col-4">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sexo" value="M" id="sexoM">
                <label for="sexoM" class="form-check-label">Macho</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sexo" value="F" id="sexoF">
                <label for="sexoF" class="form-check-label">Fêmea</label>
            </div>
        </div>
        <div class="col-4">
            <label for="observacao">Observações</label>
            <textarea name="observacao" class="form-control" id="observacao" rows="3"></textarea>
        </div>
        <br />
        <button type="submit" name="enviarDados" class="btn btn-primary" value="CAD">Cadastrar</button>
        <a href="index_logado.php" class="btn btn-danger">Cancelar</a>
    </form>
</div>
</body>
</html>
