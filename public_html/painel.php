<?php
include 'protecao.php';
include '../config/conexao.php';
$atualizar = false;

// lógica para pegar dados do formulário cadastro tombamentos e inserir no mysql
if (isset($_POST['cadastrarTombamento'])) {
  $id = $_POST['id'];
  $secretaria = $_POST['secretaria'];
  $tecnico = $_POST['tecnico'];
  $dataHora = $_POST['dataHora'];
  $prioridade = $_POST['prioridade'];
  $descricao = $_POST['descricao'];
  $status = $_POST['status'];

  $resultado = mysqli_query($conexao, "INSERT INTO tombamentos(tombamento_id, secretaria, tecnico, entrada, prioridade, descricao, status) VALUES ($id, '$secretaria', '$tecnico', '$dataHora', '$prioridade', '$descricao', '$status')");
}

// lógica para ordenar os itens por entrada
$sqlExibir = "SELECT * FROM tombamentos ORDER BY entrada DESC";  // pega tudo, incluindo indice (chave primária)
$resultadoTombamentos = $conexao->query($sqlExibir);

// lógica para alterar dados dos tombamentos
if (isset($_GET['indice'])) {
  $indice = $_GET['indice'];
  $selecionarDados = mysqli_query($conexao, "SELECT * FROM tombamentos WHERE indice=$indice");
  $atualizar = true;

  if (mysqli_num_rows($selecionarDados) == 1) {
    $dadosSQL = mysqli_fetch_array($selecionarDados); // dados sql é tipo o objeto tombamento que contém os dados do mesmo.
    $indice = $dadosSQL['indice'];
    $tombamento_id = $dadosSQL['tombamento_id'];
    $secretaria = $dadosSQL['secretaria'];
    $tecnico = $dadosSQL['tecnico'];
    $entrada = $dadosSQL['entrada'];
    $prioridade = $dadosSQL['prioridade'];
    $descricao = $dadosSQL['descricao'];
    $status = $dadosSQL['status'];
  }
}

if (isset($_REQUEST['salvar'])) {
  echo "Salvar iniciado.";
  $indice = $dadosSQL['indice'];
  $tombamento_id = $dadosSQL['tombamento_id'];
  $secretaria = $dadosSQL['secretaria'];
  $tecnico = $dadosSQL['tecnico'];
  $entrada = $dadosSQL['entrada'];
  $prioridade = $dadosSQL['prioridade'];
  $descricao = $dadosSQL['descricao'];
  $status = $dadosSQL['status'];
  mysqli_query($conexao, "INSERT INTO tombamentos(tombamento_id, secretaria, tecnico, entrada, prioridade, descricao, status) VALUES ($id, '$secretaria', '$tecnico', '$dataHora', '$prioridade', '$descricao', '$status')");
  $_SESSION['msg'] = "Salvo.";
  header("location:index.php");
}

if (isset($_REQUEST['atualizar'])) {
  echo "Atualizar iniciado.";
  $indice = $dadosSQL['indice'];
  $tombamento_id = $dadosSQL['tombamento_id'];
  $secretaria = $dadosSQL['secretaria'];
  $tecnico = $dadosSQL['tecnico'];
  $entrada = $dadosSQL['dataHora'];
  $prioridade = $dadosSQL['prioridade'];
  $descricao = $dadosSQL['descricao'];
  $status = $dadosSQL['status'];

  mysqli_query($conexao, "UPDATE tombamentos 
                          SET tombamento_id='$tombamento_id', secretaria='$secretaria', tecnico='$tecnico', entrada='$entrada', prioridade='$prioridade', descricao='$descricao', status='$status' 
                          WHERE indice=$indice");
  $_SESSION['msg'] = "Atualizado.";
  // isso aqui é necessário pra poder limpar o form 
  header("location:index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['retornar'])) {
    // po nao faço ideia do pq rola isso mas era pra ter um header painel.php aqui pra limpar a url, mas aparentemente já faz isso msm sem header, apenas com submit, vou deixar aqui pq foi bem engraçado.
  }
}
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
            $status = $tombamentosDados['status']; // mesma coisa, só que pra status
            $classPrioridade = '';
            $classStatus = '';
            $textoStatus = '';
            $corPrioridade = '';

            echo "<tr>";
            echo "<th>" . $tombamentosDados['tombamento_id'] . "</th>";
            echo "<td>" . strtoupper($tombamentosDados['secretaria']) . "</td>";
            echo "<td>" . ucfirst($tombamentosDados['tecnico']) . "</td>";
            echo "<td>" . $tombamentosDados['entrada'] . "</td>";
            echo "<td>" . $tombamentosDados['saida'] . "</td>";
            if ($prioridade === 'minima') {
              $classPrioridade = 'spinner-grow spinner-grow-sm text-success pararAnimacao';
            } elseif ($prioridade === 'moderada') {
              $classPrioridade = 'spinner-grow spinner-grow-sm text-warning';
            } elseif ($prioridade === 'maxima') {
              $classPrioridade = 'spinner-grow spinner-grow-sm text-danger';
            }
            echo "<td>
                    <div class=\"$classPrioridade\" role=\"status\" >
                      <span class=\"visually-hidden\">Loading...</span>
                    </div>
                  </td>";
            if ($status === 'finalizado') {
              $textoStatus = "| Finalizado";
              $classStatus = 'spinner-grow spinner-grow-sm text-success pararAnimacao';
            } elseif ($status === 'estragado') {
              $textoStatus = "| Estragado";
              $classStatus = 'spinner-grow spinner-grow-sm text-dark pararAnimacao';
            } elseif ($status === 'consertando') {
              $textoStatus = "| Consertando";
              $classStatus = 'spinner-grow spinner-grow-sm text-primary';
            } elseif ($status === 'avaliando') {
              $textoStatus = "| Avaliando";
              $classStatus = 'spinner-grow spinner-grow-sm text-info';
            } elseif ($status === 'aguardando_entrega') {
              $textoStatus = "| Aguardando Entrega";
              $classStatus = 'spinner-grow spinner-grow-sm text-warning';
            }
            // aqui ele vai receber dependendo da lógica, a classe de classStatus, e no style a gente altera a velocidade da bolinha.
            // a classe **pararAnimacao**, para a animação do bootstrap e mantém o transform em scale(1), mostrando todo seu tamanho.
            echo "<td style='text-align: left;'>
                    <div class=\"$classStatus\" role=\"status\" >
                        <span class=\"visually-hidden\">Loading...</span>
                    </div>
                    <a>$textoStatus</a>
                  </td>";
            echo
            '<td>
            <div class="acoes-tab">
              <div class="editar">
                <a class="editarBtns" href="painel.php?indice=' . $tombamentosDados['indice'] . '">
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
          <a id="cadastrar" href="javascript:void(0);">
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

      <!-- se atualizar for true, então a caixa já mudará para ativo. -->
      <?php
      if ($atualizar) {
        echo '<div class="janelaCadastrarAtivo" id="janelaCadastrar">';
      } else {
        echo '<div class="janelaCadastrar" id="janelaCadastrar">';
      }
      ?>
      <form action="painel.php" method="POST">
        <div class="campoEntrada">
          <label for="id">Tombamento</label>
          <input type="text" id="id" name="id" value="<?php echo isset($indice) ? $tombamento_id : ''; ?>" />
        </div>
        <div class="campoEntrada">
          <label for="secretaria">Secretaria</label>
          <input placeholder="SEMURFH, SEMAD..." type="text" id="secretaria" name="secretaria" value="<?php echo isset($indice) ? $secretaria : ''; ?>" />
        </div>
        <div class="campoEntrada">
          <label for="tecnico">Técnico</label>
          <input type="text" id="tecnico" name="tecnico" value="<?php echo isset($indice) ? $tecnico : ''; ?>" />
        </div>
        <div class="campoEntrada">
          <label for="dataHora">Entrada (DD-MM-AAAA)</label>
          <input class="dataHora" type="datetime-local" id="dataHora" name="dataHora" value="<?php echo isset($indice) ? $dataHora : ''; ?>" />
        </div>
        <div class="campoEntrada">
          <label for="prioridade">Prioridade:</label>
          <select name="prioridade" id="prioridade">
          <option value="minima" <?php echo (isset($indice) && $prioridade === 'minima') ? 'selected' : ''; ?>>Miníma</option>
          <option value="moderada" <?php echo (isset($indice) && $prioridade === 'moderada') ? 'selected' : ''; ?>>Moderada</option>
          <option value="maxima" <?php echo (isset($indice) && $prioridade === 'maxima') ? 'selected' : ''; ?>>Máxima</option>
      </select>
        </div>
        <div class="campoEntrada">
          <label for="descricao">Descrição</label>
          <input placeholder="Computador Lenovo com problema no HD..." type="text" id="descricao" name="descricao" value="<?php echo isset($indice) ? $descricao : ''; ?>" />
        </div>
        <div class="campoEntrada">
          <label for="status">Status</label>
          <select name="status" id="status">
          <!-- nao sei pq krlhos simplesmente $status nao funciona, mas $dadosSQL['status'] funciona, entao seguimos o baile. mas caso eu va refatorar dps, provavelmente tem algo a ver com escopo da função que recebe os dados, pois eles estao vindo com sucesso do sql. -->
            <option value="avaliando" 
            <?php echo (isset($indice) && $dadosSQL['status'] === 'avaliando') ? 'selected' : ''; ?>>Avaliando</option>
            <option value="estragado" 
            <?php echo (isset($indice) && $dadosSQL['status'] === 'estragado') ? 'selected' : ''; ?>>Estragado</option>
            <option value="consertando" 
            <?php echo (isset($indice) && $dadosSQL['status'] === 'consertando') ? 'selected' : ''; ?>>Consertando</option>
            <option value="aguardando_entrega" 
            <?php echo (isset($indice) && $dadosSQL['status'] === 'aguardando_entrega') ? 'selected' : ''; ?>>Aguardando Entrega</option>
            <option value="finalizado" 
            <?php echo (isset($indice) && $dadosSQL['status'] === 'finalizado') ? 'selected' : ''; ?>>Finalizado</option>
          </select>
        </div>

        <div class="btns">
          <?php if ($atualizar == true) { ?>
            <input
              type="submit"
              name="atualizar"
              value="Atualizar"
              id="atualizar"
              class="btn btn-outline-dark" />
          <?php } else { ?>
            <input
              type="submit"
              name="cadastrarTombamento"
              value="Cadastrar"
              id="cadastrar"
              class="btn btn-outline-dark" />
          <?php } ?>

          <input
            type="submit"
            name="retornar"
            value="Retornar"
            id="retornar"
            class="btn btn-outline-dark" />
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

    function abrirFecharCadastrar() {
      janelaCadastrar.classList.toggle("janelaCadastrar"); // off 
      janelaCadastrar.classList.toggle("janelaCadastrarAtivo"); // on
    }

    // adiciona ouvinte de evento para quando o usuário clicar, retornar a funçao
    window.addEventListener('DOMContentLoaded', function() {
      const cadastrarBtn = document.getElementById('cadastrar');
      if (cadastrarBtn) {
        dataHora.value = dataHoraAtual();
        cadastrarBtn.addEventListener('click', abrirFecharCadastrar);
      }

      const retornarBtn = document.getElementById('retornar');
      const editarBtns = document.querySelectorAll('.editarBtns');
      retornarBtn.addEventListener('click', abrirFecharCadastrar);
      // querySelectorAll pega todos os elementos e guarda na nodelist (no navegador), forEach itera sobre, onde irá retornar uma arrow function chamada btn que, para cada btn que encontrar, abrirá/fechará a tela de cadastro.
      editarBtns.forEach(btn => {
        btn.addEventListener('click', abrirFecharCadastrar);
      });
    });
  </script>
</body>

</html>