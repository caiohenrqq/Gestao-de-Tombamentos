<?php
include('/protecao.php');
include "../config/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tombamentos | painel</title>
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
          <!-- os dados serão inseridos aqui pelo js -->
        </tbody>
      </table>
      <!-- logout, add e refresh -->
      <div class="icons">
        <div class="cadastrar">
          <a href="javascript:void(0);" onclick="cadastrar()">
            <img class="icon" src="/icons/add.svg" alt="adicionar" />
          </a>
        </div>

        <div class="refresh">
          <a href="#" onclick="exibirDadosTombamento(); return false;">
            <img class="icon" src="/icons/refresh.svg" alt="atualizar" />
          </a>
        </div>

        <div class="remover">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/remove.svg" alt="remover" />
          </a>
        </div>

        <div class="logout">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/logout.svg" alt="deslogar" />
          </a>
        </div>
      </div>

      <!-- sessão adicionar -->

      <!-- nesta sessão, irá aparecer uma caixa que possibilitará a inserção de tombamentos -->
      <div class="janelaCadastrar" id="janelaCadastrar">
        <form action="/crud.php" method="POST">
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
            <input type="submit" name="cadastrarTombamento" value="Cadastrar" class="btn btn-outline-dark" />
            <button type="button" onclick="retornar()" class="btn btn-outline-dark">Retornar</button>
          </div>
        </form>
      </div>

      <hr class="linha" />
    </div>
  </section>
  <script>
    // exibir dados json dos tombamentos
    function exibirDadosTombamento() {
      fetch('crud.php?acao=exibirtombamentos')
        .then(response => {
          if (!response.ok) {
            console.error('erro na requisição: ' + response.status);
          }
          return response.json(); // retorna dados em json
        })

        .then(dadosTombamentos => {
          const tabela = document.getElementById('tabela');

          // se tiver dados
          if (dadosTombamentos.length > 0) {
            dadosTombamentos.forEach(dados => {
              // criar nova linha
              const row = document.createElement('tr');
              row.innerHTML = `
                        <th scope="row">${dados.id}</th>
                        <td>${dados.secretaria}</td>
                        <td>${dados.tecnico}</td>
                        <td>${dados.entrada}</td>
                        <td>${dados.prioridade}</td>
                        <td>${dados.status}</td>
                    `;
              tabela.appendChild(row);
            })
          }
        })
        document.addEventListener('DOMContentLoaded', exibirDadosTombamento);
    }

    var dataHora = document.querySelector(".dataHora");
    const element = document.getElementById('my-single-select'); // Choices.js
    const choices = new Choices(element, {
      removeItemButton: true,
      placeholderValue: "Priodade",
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

    function cadastrar(event) {
      event.preventDefault(event);
      let janelaCadastrar = document.querySelector(".janelaCadastrar");

      // Define o valor da data e hora atual
      dataHora.value = dataHoraAtual();
      janelaCadastrar.classList.toggle("janelaCadastrarAtivo"); // Torna a janela visível ou oculta
    }

    function retornar(event) {
      event.preventDefault(event);
      let janelaCadastrar = document.querySelector(".janelaCadastrar");
      janelaCadastrar.classList.remove("janelaCadastrarAtivo");
    }
  </script>
</body>

</html>