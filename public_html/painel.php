<?php
include('protecao.php');
include "../config/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tombamentos | painel</title>
  <link rel="shortcut icon" href="assets/icons/icon.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.php" />
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<body>
  <section class="painel-section bg-dark">
    <div class="bem-vindo">
      <div>
        bem-vindo ao painel de tombamentos,
        <?php echo $_SESSION['username']; ?>.
        <hr class="linhaMaiorIndependente" />
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
        <tbody id="tabela" class="table-group-divider">
          <!-- Os dados serão inseridos aqui pelo JavaScript -->
        </tbody>
      </table>
      <!-- logout, add e refresh -->
      <div class="icons">
        <div class="cadastrar">
          <a href="javascript:void(0);" onclick="cadastrar()">
            <img class="icon" src="assets/icons/add.svg" alt="adicionar" />
          </a>
        </div>

        <div class="refresh">
          <a href="../src/logout.php">
            <img class="icon" src="assets/icons/refresh.svg" alt="atualizar" />
          </a>
        </div>

        <div class="remover">
          <a href="../src/logout.php">
            <img class="icon" src="assets/icons/remove.svg" alt="remover" />
          </a>
        </div>

        <div class="logout">
          <a href="../src/logout.php">
            <img class="icon" src="assets/icons/logout.svg" alt="deslogar" />
          </a>
        </div>
      </div>

      <!-- sessão adicionar -->

      <!-- nesta sessão, irá aparecer uma caixa que possibilitará a inserção de tombamentos -->
      <div class="janelaCadastrar" id="janelaCadastrar">
        <form action="" method="POST">
          <div class="campoEntrada">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" />
          </div>
          <div class="campoEntrada">
            <label for="secretaria">Secretaria</label>
            <input placeholder="SEMURFH, SEMAD..." type="text" id="secretaria" name="secretaria" />
          </div>
          <div class="campoEntrada">
            <label for="tecnico">Técnico</label>
            <input type="text" id="tecnico" name="tecnico" />
          </div>
          <div class="campoEntrada">
            <label for="dataHora">Entrada (DD-MM-YYYY)</label>
            <input class="dataHora" type="datetime-local" id="dataHora" name="dataHora" />
          </div>

          <div class="campoEntrada">
            <label for="prioridade">Prioridade:</label>
            <select id="my-single-select">
              <option value="minima">Miníma</option>
              <option value="moderada">Moderada</option>
              <option value="maxima">Máxima</option>
            </select>
          </div>

          <div class="campoEntrada">
            <label for="descricao">Descrição</label>
            <input placeholder="Computador Lenovo com problema no HD..." type="text" id="descricao" name="descricao" />
          </div>

          <div class="btns">
            <input
              type="submit"
              name="cadastrarTombamento"
              value="Cadastrar"
              id="cadastrar"
              class="btn btn-outline-dark"/>
            <input
              type="button"
              name="cadastrarTombamento"
              value="Retornar"
              id="retornar"
              class="btn btn-outline-dark"/>
          </div>
        </form>
      </div>

      <hr class="linha" />
    </div>
  </section>

  <!-- crud tombamentos -->
  <script>
    var dataHora = document.querySelector(".dataHora");
    const element = document.getElementById('my-single-select'); // Choices.js
    const choices = new Choices(element, {
      removeItemButton: true,
      maxItemCount: 1,
      shouldSort: false,
    });

    function dataHoraAtual() {
      const data = new Date();
      const ano = data.getFullYear();
      const mes = String(data.getMonth() + 1).padStart(2, '0');
      const dia = String(data.getDate()).padStart(2, '0');
      const horas = String(data.getHours()).padStart(2, '0');
      const minutos = String(data.getMinutes()).padStart(2, '0');

      return `${ano}-${mes}-${dia}T${horas}:${minutos}`;
    }

    const janelaCadastrar = document.getElementById("janelaCadastrar"); // pega elemento janelaCadastrar

    function cadastrar() {
      dataHora.value = dataHoraAtual();

      // se janelaCadastrar for TRUE, isto é, se ela existir, utiliza o elemento toggle para alternar entre ativo e desabilitado.
      janelaCadastrar.classList.toggle("janelaCadastrar"); // off
      janelaCadastrar.classList.toggle("janelaCadastrarAtivo"); // on
    }

    function retornar() {
      janelaCadastrar.classList.toggle("janelaCadastrar"); // off
      janelaCadastrar.classList.toggle("janelaCadastrarAtivo"); // on
    }

    // adiciona ouvinte de evento para quando o usuário clicar, retornar a funçao

    window.addEventListener('DOMContentLoaded', function() {
      const cadastrarBtn = document.getElementById('cadastrar');
      const retornarBtn = document.getElementById('retornar');
      cadastrarBtn.addEventListener('click', cadastrar);
      retornarBtn.addEventListener('click', retornar);
    });
  </script>
</body>

</html>