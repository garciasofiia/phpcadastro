<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        $host = 'localhost';
        $db = 'senaizin_alunhaphp';
        $user = 'garciasofiiaa';
        $pass = '123456';
        $port = 3307; // Porta MySQL correta

        // Inclui o arquivo da classe Database que criamos para conectar dentro da pasta php
        require_once 'connection.php';

        // Cria uma instância da classe Database
        $database = new Database($host, $db, $user, $pass, $port);

        // Chama o método connect para estabelecer a conexão
        $database->connect();

        // Obtém a instância PDO para realizar consultas
        $pdo = $database->getConnection();
    ?>
</head>
<body>
<?php
if (isset($_GET['nome']) && isset($_GET['email']) && isset($_GET['mensagem'])) {

    // Captura os dados enviados pelo formulário
    $nome = htmlspecialchars($_GET['nome']);
    $email = htmlspecialchars($_GET['email']);
    $mensagem = htmlspecialchars($_GET['mensagem']);

    // Exibe os dados capturados
    echo "<h2>Informações Recebidas:</h2>";
    echo "<p><strong>Nome:</strong> " . $nome . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
    echo "<p><strong>Mensagem:</strong> " . $mensagem . "</p>";

    // Prepara a consulta SQL para inserir os dados no banco de dados
    $stmt = $pdo->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem);");

    
    // Vincula os parâmetros para proteger contra SQL Injection
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mensagem', $mensagem);

    // Executa a consulta
    $stmt->execute();

} else {
    echo "Nenhum dado foi enviado.";
}
?>
</body>
</html>
