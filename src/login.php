<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // verifica se os dados foram enviados e não são nulos
  if (isset($_POST['x']) && isset($_POST['y'])) {
    $username;
    $senha;

    // chama função entrr se o botão 'entrar' for pressionado
    if (isset($_POST['entrar'])) {
      entrar($username, $senha);
    } else {
      echo "erro!";
    }
  }

  function entrar($username, $senha) {
  }
}