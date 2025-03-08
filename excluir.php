<?php
include 'conexao.php';


//parei aqui, tem que mexer no pdo! Foi quase, faltou 1 segundo só :( 
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>