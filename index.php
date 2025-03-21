<?php
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $quantidade, $preco]);

    header("Location: index.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 1000px; }
        .table-hover tbody tr:hover { background-color: #e9ecef; }
        .btn-sm { font-size: 0.875rem; }
        .navbar { background-color: #343a40; }
        .navbar-dark .navbar-nav .nav-link { color: white; }
        .navbar-dark .navbar-nav .nav-link:hover { color: #ddd; }
        .navbar-dark .navbar-nav .nav-link.active { font-weight: bold; }
        .navbar-dark .navbar-nav .nav-link { margin-right: 10px; }
        .navbar-dark .navbar-brand { font-weight: bold; }
        .table-bordered th, .table-bordered td { text-align: center; vertical-align: middle; }
        .card { border: none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: #007bff; color: white; }
        .card-body { padding: 20px; }
    </style>
</head>
<body class="container mt-4">

    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Estoque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adicionar.php"><i class="fa fa-plus"></i> Adicionar Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editar.php"><i class="fa fa-edit"></i> Editar Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="excluir.php"><i class="fa fa-trash"></i> Excluir Produto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card">
        <div class="card-header">
            <h2 class="text-center">📦 Controle de Estoque</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produtos)): ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto['id']) ?></td>
                                <td><?= htmlspecialchars($produto['nome']) ?></td>
                                <td><?= htmlspecialchars($produto['descricao']) ?></td>
                                <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                                <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="editar.php?id=<?= $produto['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $produto['id'] ?>)">
                                        <i class="fa fa-trash"></i> Excluir
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este produto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="confirmarExclusaoBtn" class="btn btn-danger">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmarExclusao(id) {
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            document.getElementById('confirmarExclusaoBtn').setAttribute('data-id', id);
            modal.show();
        }

        document.getElementById('confirmarExclusaoBtn').addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = `excluir.php?id=${id}`;
        });
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>