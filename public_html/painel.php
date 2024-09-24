<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tombamentos | painel</title>
  <link rel="stylesheet" href="assets/css/style.php" />
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>
<body>
  <section class="painel-section bg-dark">
    <div class="bem-vindo">
      <div>
        bem-vindo ao painel de tombamentos, <?php echo $_SESSION['username']; ?>.
        <hr class="linhaMaiorIndependente" />
      </div>

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
        <tbody id="tabela" class="table-group-divider"></tbody>
      </table>

      <div class="icons">
        <div class="cadastrar">
          <a href="javascript:void(0);" onclick="toggleCadastro()">
            <img class="icon" src="/icons/add.svg" alt="adicionar" />
          </a>
        </div>
        <div class="refresh">
          <a href="#" onclick="exibirDadosTombamento(); return false;">
            <img class="icon" src="/icons/refresh.svg" alt="atualizar" />
          </a>
        </div>
        <div class="logout">
          <a href="../src/logout.php">
            <img class="icon" src="/icons/logout.svg" alt="deslogar" />
          </a>
        </div>
      </div>

      <div class="janelaCadastrar" id="janelaCadastrar">
        <form id="formCadastro" onsubmit="return cadastrar(event);">
          <div class="campoEntrada">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" required />
          </div>
          <div class="campoEntrada">
            <label for="secretaria">Secretaria</label>
            <input placeholder="SEMURFH, SEMAD..." type="text" id="secretaria" name="secretaria" required />
          </div>
          <div class="campoEntrada">
            <label for="tecnico">Técnico</label>
            <input type="text" id="tecnico" name="tecnico" required />
          </div>
          <div class="campoEntrada">
            <label for="dataHora">Entrada (DD-MM-YYYY)</label>
            <input class="dataHora" type="datetime-local" id="dataHora" name="dataHora" required />
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
            <input placeholder="Computador Lenovo com problema no HD..." type="text" id="descricao" name="descricao" required />
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
    function exibirDadosTombamento() {
      fetch('crud.php?acao=exibirtombamentos')
        .then(response => {
          if (!response.ok) {
            console.error('erro na requisição: ' + response.status);
          }
          return response.json();
        })
        .then(dadosTombamentos => {
          const tabela = document.getElementById('tabela');
          tabela.innerHTML = ''; // Limpa a tabela antes de adicionar novos dados
          if (dadosTombamentos.length > 0) {
            dadosTombamentos.forEach(dados => {
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
            });
          }
        });
    }

    document.addEventListener('DOMContentLoaded', exibirDadosTombamento);

    const element = document.getElementById('my-single-select');
    const choices = new Choices(element, {
      removeItemButton: true,
      placeholderValue: "Prioridade",
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

    function toggleCadastro() {
      const janelaCadastrar = document.querySelector(".janelaCadastrar");
      if (janelaCadastrar) {
        janelaCadastrar.classList.toggle("janelaCadastrarAtivo");
      }
    }

    function retornar() {
      const janelaCadastrar = document.querySelector(".janelaCadastrar");
      if (janelaCadastrar) {
        janelaCadastrar.classList.remove("janelaCadastrarAtivo");
      }
    }

    function cadastrar(event) {
      event.preventDefault(); // Previne o envio do formulário

      // Aqui você pode validar os campos se necessário
      // Depois de validar, você pode enviar os dados via AJAX ou submeter o formulário normalmente
      const form = document.getElementById('formCadastro');
      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        // Aqui você pode tratar a resposta do servidor
        console.log(data);
        // Por exemplo, exibir mensagem de sucesso ou atualizar a tabela
        exibirDadosTombamento(); // Atualiza a tabela após cadastrar
        retornar(); // Fecha a janela de cadastro
      })
      .catch(error => {
        console.error('Erro ao cadastrar:', error);
      });

      return false; // Impede o envio do formulário padrão
    }
  </script>
</body>
</html>
