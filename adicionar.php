<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $quantidade = $_POST["quantidade"];
    $preco = $_POST["preco"];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
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
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color:rgb(40, 110, 167);
        }
        .btn-custom {
            width: 100%;
            font-size: 18px;
        }
        .form-control {
            border-radius: 8px;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Adicionar Produto</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nome do Produto:</label>
                <input type="text" name="nome" class="form-control" placeholder="Digite o nome" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descrição:</label>
                <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o produto"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" min="1" placeholder="Digite a quantidade" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço (R$):</label>
                <input type="text" name="preco" class="form-control" placeholder="Digite o preço" required>
            </div>
            
            <button type="submit" class="btn btn-success btn-custom">Salvar</button>
            <a href="index.php" class="btn btn-secondary btn-custom mt-2">Cancelar</a>
        </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
</html>
