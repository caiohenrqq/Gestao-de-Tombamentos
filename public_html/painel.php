<?php
include 'protecao.php';
include '../config/conexao.php';
include 'editar.php';

// lógica para pegar dados do formulário cadastro tombamentos e inserir no mysql
if (isset($_POST['cadastrarTombamento'])) {
  $id = $_POST['id'];
  $secretaria = $_POST['secretaria'];
  $tecnico = $_POST['tecnico'];
  $dataHora = $_POST['dataHora'];
  $prioridade = $_POST['prioridade'];
  $descricao = $_POST['descricao'];
  $status = 1;

  $resultado = mysqli_query($conexao, "INSERT INTO tombamentos(tombamento_id, secretaria, tecnico, entrada, prioridade, descricao) VALUES ($id, '$secretaria', '$tecnico', '$dataHora', '$prioridade', '$descricao')");
}

// lógica para ordenar os itens por entrada
$sqlExibir = "SELECT * FROM tombamentos ORDER BY entrada DESC";  // pega tudo
$resultadoTombamentos = $conexao->query($sqlExibir);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tombamentos | painel</title>
  <!-- icone logo -->
  <link rel="shortcut icon" href="assets/icons/favicon.png" type="image/x-icon">
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
<style>
        .table-borderless th, 
        .table-borderless td {
            border-bottom: 1px solid #ccc;
        }

        .table-borderless th,
        .table-borderless td {
            padding-bottom: 5px;
        }
    </style>
  <section class="painel-section bg-dark">
    <div class="bem-vindo">
      <div>
        bem-vindo ao painel de tombamentos,
        <?php echo $_SESSION['username']; ?>.
        <hr class="linhaMaiorIndependente" />
      </div>

      <!-- tabela -->
      <table class="table table-hover table-striped table-borderless">
        <thead>
          <tr>
            <th scope="col">Tombamento</th>
            <th scope="col">Secretaria</th>
            <th scope="col">Técnico</th>
            <th scope="col">Entrada</th>
            <th scope="col">Saída</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody id="tabela" class="table-group-divider">
          <?php
          while ($tombamentosDados = mysqli_fetch_assoc($resultadoTombamentos)) {
            $prioridade = $tombamentosDados['prioridade']; // implementação para mudar a cor de prioridade, dependendo do que o técnico ter escolhido
            $class = '';
            echo "<tr>";
            echo "<th>".$tombamentosDados['tombamento_id']."</th>";
            echo "<td>".strtoupper($tombamentosDados['secretaria'])."</td>";
            echo "<td>".ucfirst($tombamentosDados['tecnico'])."</td>";
            echo "<td>".$tombamentosDados['entrada']."</td>";
            echo "<td>".$tombamentosDados['saida']."</td>";
            if ($prioridade === 'minima') {
                $class = 'table-success'; 
            } elseif ($prioridade === 'moderada') {
                $class = 'table-warning';
            } elseif ($prioridade === 'maxima') {
                $class = 'table-dark';
            }
            echo "<td class=\"$class\">"."</td>";
            echo "<td>".$tombamentosDados['status']."</td>";
            echo 
            '<td>
            <div class="acoes-tab">
              <div class="editar">
                <a href="#?id='.$tombamentosDados['indice'].'">
                  <img class="icon" src="assets/icons/edit.svg" alt="editar" />
                </a>
              </div>
              <div class="remover">
                <a href="logout.php">
                  <img class="icon" src="assets/icons/remove.svg" alt="remover" />
                </a>
              </div>
            </div>
            </td>';
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      <!-- logout e add -->
      <div class="icons">
        <div class="cadastrar">
          <a href="javascript:void(0);" onclick="cadastrar()">
            <img class="icon" src="assets/icons/add.svg" alt="adicionar" />
          </a>
        </div>

        <div class="logout">
          <a href="/logout.php">
            <img class="icon" src="assets/icons/logout.svg" alt="deslogar" />
          </a>
        </div>
      </div>

      <!-- sessão adicionar -->

      <!-- nesta sessão, irá aparecer uma caixa que possibilitará a inserção de tombamentos -->
      <div class="janelaCadastrar" id="janelaCadastrar">
        <form action="painel.php" method="POST">
          <div class="campoEntrada">
            <label for="id">Tombamento</label>
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
            <label for="dataHora">Entrada (DD-MM-AAAA)</label>
            <input class="dataHora" type="datetime-local" id="dataHora" name="dataHora" />
          </div>

          <div class="campoEntrada">
            <label for="prioridade">Prioridade:</label>
            <select name="prioridade" id="prioridade">
              <option value="minima">Miníma</option>
              <option value="moderada">Moderada</option>
              <option value="maxima">Máxima</option>
            </select>
          </div>

          <div class="campoEntrada">
            <label for="descricao">Descrição</label>
            <input placeholder="Computador Lenovo com problema no HD..." type="text" id="descricao" name="descricao" />
          </div>
          
          <div class="campoEntrada">
            <label for="status">Status</label>
            <select name="status" id="status">
              <option value="avaliando">Avaliando</option>
              <option value="estragado">Estragado</option>
              <option value="consertando">Consertando</option>
              <option value="aguardando_entrega">Aguardando Entrega</option>
              <option value="finalizado">Finalizado</option>
            </select>
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
    const prioridade = document.getElementById('prioridade'); // Choices.js
    const prioridadeChoices = new Choices(prioridade, {
      removeItemButton: true,
      maxItemCount: 2,
      shouldSort: false,
      maxItemCount: () => 'Você pode adicionar apenas 1 item.',
      placeholderValue: 'Qual a prioridade?',
      itemSelectText: '',
    });
    
    const status = document.getElementById('status'); // Choices.js
    const statusChoices = new Choices(status, {
      removeItemButton: true,
      maxItemCount: 2,
      shouldSort: false,
      maxItemCount: () => 'Você pode adicionar apenas 1 item.',
      placeholderValue: 'Qual a prioridade?',
      itemSelectText: '',
    });

    function dataHoraAtual() {
      const data = new Date();
      const ano = data.getFullYear();
      const mes = String(data.getMonth() + 1).padStart(2, '0');
      const dia = String(data.getDate()).padStart(2, '0');
      const horas = String(data.getHours()).padStart(2, '0');
      const minutos = String(data.getMinutes()).padStart(2, '0');
      // alterar formato da datas  
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