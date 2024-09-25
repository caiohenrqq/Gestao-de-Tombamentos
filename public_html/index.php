<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.php">
  <title>tombamentos | login</title>
  <!-- icone logo -->
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
  <link rel="preconnect" href="https://rsms.me/">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- sessão de login -->
  <section class="login-section bg-dark">
    <div class="login-box">
      <form action="autenticacao.php" method="POST">
        <input type="text" maxlength="10" required id="username" placeholder="identificação" name="username">
        <input type="password" required id="senha" placeholder="senha" name="senha">
        <button class="btn btn-outline-dark" type="submit" name="entrar" value="entrar">entrar</button>
        <button onclick="location.href = 'cadastrar.php';" class="btn btn-outline-dark" type="button" name="cadastrar" value="cadastrar">cadastrar</button>
      </form>
    </div>
  </section>
</body>

</html>