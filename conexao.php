<?php

$host = "localhost"; //aponta para o endereço web do banco de dados
$dbname = "estoque"; //nome do banco de dados
$username = "root"; //usuário
$password = ""; //senha do banco de dados

try{
    // Correção aqui: mysqli -> mysql
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password); 
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $error){
    die("Erro na conexão com banco de dados!: ".$error->getMessage());
}
?>
