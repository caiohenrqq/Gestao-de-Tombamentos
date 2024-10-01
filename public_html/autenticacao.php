<?php
include "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // verifica se os dados foram enviados e não são nulos
    if (isset($_POST['username']) && isset($_POST['senha'])) {
        $username = $_POST['username'];
        $senha = $_POST['senha'];

        // chama a função 'entrar' se o botão 'entrar' for pressionado
        if (isset($_POST['entrar'])) {
            entrar($username, $senha);
        }
        // chama a função 'cadastrar' se o botão 'cadastrar' for pressionado
        if (isset($_POST['cadastrar'])) {
            cadastrar($username, $senha, $_POST['email']);
        }
    } else {
        echo "Dados incompletos!";
    }
}

function entrar($username, $senha) {
    global $conexao;

    // evitar SQL Injection
    $username = $conexao->real_escape_string($username);
    $senha = $conexao->real_escape_string($senha);

    // pega dados do SQL
    $sql_verifica = "SELECT * FROM tecnicos WHERE nome = '$username' AND senha = '$senha'";
    $sql_query = $conexao->query($sql_verifica) or die("falha na execução do código SQL: " . $conexao->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['username'] = $usuario['nome'];

        header("Location: painel.php");
    } else {
        echo "Erro ao logar, id do técnico ou senha incorretos.";
    }
}

function cadastrar($username, $senha, $email) {
    global $conexao;

    $username = $conexao->real_escape_string($username);
    $senha = $conexao->real_escape_string($senha);
    $email = $conexao->real_escape_string($email);

    $sql = "INSERT INTO tecnicos (nome, email, senha) VALUES ('$username', '$email', '$senha')";

    if ($conexao->query($sql) === TRUE) {
        echo "Debug: Usuário adicionado, id: " . $conexao->insert_id . ".";
    } else {
        echo "Erro: " . $conexao->error;
    }

    $conexao->close();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.php">
  <title>tombamentos | cadastro</title>
  <!-- icone logo -->
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <link rel="preconnect" href="https://rsms.me/">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- sessão de login -->
  <section class="cadastrar-section bg-dark">
    <div class="cadastrar-box">
        <p style="font-size: 1rem">Cadastro realizado com sucesso!</p>
        <button onclick="location.href = 'index.php';" class="btn btn-outline-dark" type="button" name="retornar" value="retornar">retornar</button>
    </div>
  </section>
</body>

</html>