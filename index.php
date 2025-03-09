<?php
include 'conexao.php';

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-4"> 
    <!-- Adicionado um botão para adicionar produtos e centralizado o título -->
    <h2 class="text-center">Controle de estoque</h2>
    <a href="adicionar.php" class="btn btn-success mb-3">Adicionar produto</a>
    <table class="table table-bordered">
        <!-- Cabeçalho da tabela -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <!-- Corpo da tabela, exibindo os produtos -->
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= $produto['nome'] ?></td>
                    <td><?= $produto['descricao'] ?></td>
                    <td><?= $produto['quantidade'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td> 
                    <td>
                        <a href="editar.php?id=<?= $produto['id'] ?>" class="btn btn-warnig btn-sm">Editar</a>
                        <a href="excluir.php?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
