<?php
include('src\protecao.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tombamentos | painel</title>
  <link rel="stylesheet" href="style.php">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <section class="painel-section bg-dark">   
    <div class="bem-vindo">
      <div>bem vindo ao painel de tombamentos, <?php echo $_SESSION['username'];?>.
      <hr class="linhaMaiorIndependente">
    </div>
      <!-- logout -->
      <div class="logout">
        <a href="../src/logout.php">
          <img class="icon" src="/icons/logout.svg" alt="deslogar">
        </a>
      </div>
      <hr class="linha">
    </div>
  </section>
</body>
</html>