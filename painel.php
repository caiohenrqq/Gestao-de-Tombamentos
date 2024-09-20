<?php
include('src\protecao.php');
include('src\conexao.php');

function adicionar() {
}

function atualizar() {

}

function remover() {

}

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
      <div>bem-vindo ao painel de tombamentos, <?php echo $_SESSION['username'];?>.
      <hr class="linhaMaiorIndependente">
    </div>

     <!-- tabela -->
     <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Secretaria</th>
          <th scope="col">Técnico</th>
          <th scope="col">Entrada</th>
          <th scope="col">Saída</th>
          <th scope="col">Prioridade</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <tr>
          <th scope="row">1</th>
          <td>Secretaria</td>
          <td>Técnico</td>
          <td>Entrada</td>
          <td>Saída</td>
          <td>Prioridade</td>
          <td>Status</td>
        </tr>
      </tbody>
    </table>
      <!-- logout, add e refresh -->
      <div class="icons">
        <div class="cadastrar">
          <a href="javascript:void(0);" onclick="cadastrar()">
            <img class="icon" src="/icons/add.svg" alt="adicionar">
          </a>
        </div>

        <div class="refresh">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/refresh.svg" alt="atualizar">
          </a>
        </div>
        
        <div class="remover">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/remove.svg" alt="remover">
          </a>
        </div>

        <div class="logout">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/logout.svg" alt="deslogar">
          </a>
        </div>
        
      </div>

      <!-- sessão adicionar -->

      <!-- nesta sessão, irá aparecer uma caixa que possibilitará a inserção de tombamentos -->
       <div class="janelaCadastrarAtivo" id="janelaCadastrar">
        <form action="..." method="POST">
        <label for=""></label>
        <input type="text" id="..." name="...">
        
        <label for=""></label>
        <input type="text" id="..." name="...">

        <button type="submit" onclick="cadastrar()" class="btn btn-outline-dark" name="cadastrar" value="cadastrar">cadastrar</button>
        <button class="btn btn-outline-dark">
          retornar
          <!-- esse botão irá fazer desaparecer a caixa de criação de novos tombamentos -->

        </button>
        </form>
       </div> 

      <hr class="linha">
    </div>
  </section>


</body>
<script>
  function cadastrar() {
    let janelaCadastrar = document.querySelector('.janelaCadastrar'); // pega elemento janelaCadastrar

    if (janelaCadastrar) {  // se janelaCadastrar for TRUE, ou seja, se existir, então executa:
      janelaCadastrar.classList.remove('janelaCadastrar');
      janelaCadastrar.classList.add('janelaCadastrarAtivo');
    } else {
      console.log('Elemento não encontrado');
    }
  }
</script>
</html>