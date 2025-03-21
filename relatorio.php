<?php
require"conexao.php";
//$produtoModel = new Product($pdo);
$produtos = $produtoModel->getALL();
?>
<h1>Relatorio de estoque</h1>
<ul>
    <?php foreach ($produtos as $produtos): ?>
    <li>
        <?php
         echo $produtos['nome'];?> - <?php echo $produtos['quantidade'];?> Unidades
    </li>
    <?php endforeach; ?>
</ul>