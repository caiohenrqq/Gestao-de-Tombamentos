<?php
include('src\protecao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tombamentos | painel</title>
</head>
<body>
  <h1>bem vindo ao painel de tombamentos, <?php echo $_SESSION['username'];?>.</h1>

  <p>
    <a href="/src/logout.php">Sair</a>
  </p>
</body>
</html>