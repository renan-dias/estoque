<?php

$host = "localhost";
$dbname = "estoque";
$username = "root";
$password = "";

try{
    // Correção aqui: mysqli -> mysql
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password); 
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $error){
    die("Erro na conexão com banco de dados!: ".$error->getMessage());
}
?>
