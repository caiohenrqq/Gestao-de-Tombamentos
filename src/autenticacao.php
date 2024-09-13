<?php

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // verifica se os dados foram enviados e não são nulos
  if (isset($_POST['username']) && isset($_POST['senha']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    // chama função entrr se o botão 'entrar' for pressionado
    if (isset($_POST['entrar'])) {
      entrar($username, $senha);
  }
    // chama função 'cadastrar' se o botão 'cadastrar' for pressionado
    if (isset($_POST['cadastrar'])) {
        cadastrar($username, $senha, $email);
      }
      else {
        echo "Dados incompletos!";
      }
  }
}

  function entrar($username, $senha) {
    echo "...";
  }
  
  function cadastrar($username, $senha, $email) {
    global $conexao;

    $sql = "INSERT INTO tecnicos (nome, email, senha) VALUES ('$username', '$email', '$senha')";
    
    if ($conexao->query($sql) === TRUE) {
      echo "usuário adicionado, id: " . $conexao->insert_id . ".";
    } else {
      echo "erro: " . $conexao->error;
    }

    $conexao->close();
  }
