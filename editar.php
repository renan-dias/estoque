<?php
include 'conexao.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];

    $stmt = $pdo->prepare("UPDATE produtos SET nome=?, descricao=?, quantidade=?, preco=? WHERE id=?");
    $stmt->execute([$nome, $descricao, $quantidade, $preco, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Editar Produto</h2>
    <form method="post">
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Quantidade:</label>
            <input type="number" name="quantidade" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Preço:</label>
            <input type="text" name="preco" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
        
    </form>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

