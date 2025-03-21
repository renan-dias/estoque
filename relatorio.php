<?php
require "conexao.php";
//$produtoModel = new product($pdo);
$produtos = $produtoModel->getAll();
?>
<h1>Relaório de estoque</h>
<ul>
 <?php foreach ($produtos as $produtos): ?>
    <li>
     <?php echo $produtos['nome'];?> - <php echo $produtos['quantidade'];?> Unidades
    </li>
 <?php endforeach; ?>
</ul>