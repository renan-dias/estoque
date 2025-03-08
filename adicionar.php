<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];
    
    $stmt = $pdo->prepare("INSERT INTO produtos (pet, nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $quantidade, $preco]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Adicionar Produto</h2>
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
        
        <button type="submit" class="btn btn-sucess">Salvar</button>
        <a href="index.php" class="btn btn-secundary">Salvar</a>
        
    </form>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
