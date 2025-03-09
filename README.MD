# Projeto de Estoque com PDO

## Introdução

Bem-vindos ao projeto de Estoque! Este projeto foi desenvolvido para demonstrar o uso do PHP Data Objects (PDO) em um contexto de gerenciamento de estoque. O PDO é uma extensão do PHP que fornece uma interface para acessar bancos de dados de maneira segura e eficiente.

## Objetivos

- Demonstrar a utilização do PDO para conexão e manipulação de dados em um banco de dados.
- Fornecer um exemplo prático de um sistema de gerenciamento de estoque.
- Ajudar os alunos a entenderem como podem adaptar este projeto para criar suas próprias versões.

## Estrutura do Projeto

O projeto está organizado da seguinte forma:

```
/c:/xampp/htdocs/estoque/
│
├── index.php
├── adicionar.php
├── conexao.php
├── editar.php
├── excluir.php
├── index.php
|
└── README.MD
```

## Configuração do Ambiente

1. **Clone o repositório**:
    ```bash
    git clone https://github.com/renan-dias/estoque.git
    ```

2. **Configuração do Banco de Dados**:
    - Crie um banco de dados MySQL.
    - Importe o arquivo `banco.sql` para criar as tabelas necessárias.

3. **Configuração do Projeto**:
    - Edite o arquivo `config.php` com as informações do seu banco de dados:
    ```php
    <?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'estoque');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    ?>
    ```

## Utilização do PDO

### Conexão com o Banco de Dados

A conexão com o banco de dados é feita através do arquivo `db/connection.php`:

```php
<?php
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar: ' . $e->getMessage());
}
?>
```

### Modelo de Produto

O modelo `Product.php` contém métodos para interagir com a tabela de produtos:

```php
<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $quantity) {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, quantity) VALUES (:name, :quantity)');
        $stmt->execute(['name' => $name, 'quantity' => $quantity]);
    }
}
?>
```

### Exemplo de Uso

No arquivo `index.php`, você pode ver um exemplo de como utilizar o modelo `Product`:

```php
<?php
require 'config.php';
//padrão de importação dos arquivos em php

$productModel = new Product($pdo);

// Adicionar um novo produto
$productModel->create('Produto Exemplo', 10);

// Listar todos os produtos
$products = $productModel->getAll();
foreach ($products as $product) {
    echo $product['name'] . ' - ' . $product['quantity'] . '<br>';
}
?>
```

## Conclusão

Este projeto serve como um ponto de partida para entender o uso do PDO em aplicações PHP. Sinta-se à vontade para modificar e expandir este projeto para atender às suas necessidades específicas. Boa sorte e bons estudos!
