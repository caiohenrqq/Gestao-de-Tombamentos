<?php
include "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // verifica se os dados foram enviados e não são nulos
  if (isset($_POST['id']) && isset($_POST['secretaria']) && isset($_POST['tecnico']) && isset($_POST['dataHora']) && isset($_POST['prioridade']) && isset($_POST['descricao'])) {
      // pega dados do tombamento
      $id = $_POST['id'];
      $secretaria = $_POST['secretaria'];
      $tecnico = $_POST['tecnico'];
      $dataHora = $_POST['dataHora'];
      $prioridade = $_POST['prioridade'];
      $descricao = $_POST['descricao'];

      // chama a função 'entrar' se o botão 'entrar' for pressionado
      if (isset($_POST['cadastarTombamento'])) {
        cadastrarTombamento();
      }
  } else {
      echo "Dados incompletos!";
  }
}

function cadastrarTombamento() {
  global $conexao;

  $id = $_POST['id'];
  $secretaria = $_POST['secretaria'];
  $tecnico = $_POST['tecnico'];
  $dataHora = $_POST['dataHora'];
  $prioridade = $_POST['prioridade'];
  $descricao = $_POST['descricao'];

  $id = $conexao->real_escape_string($id);
  $secretaria = $conexao->real_escape_string($secretaria);
  $tecnico = $conexao->real_escape_string($tecnico);
  $dataHora = $conexao->real_escape_string($dataHora);
  $prioridade = $conexao->real_escape_string($prioridade);
  $descricao = $conexao->real_escape_string($descricao);

  $sql = "INSERT INTO tombamentos (id, secretaria, tecnico, dataHora, prioridade, descricao) VALUES ('id', 'secretaria', 'tecnico', 'dataHora', 'prioridade', 'descricao')";

  if ($conexao->query($sql) === TRUE) {
    echo "tombamento " . $conexao->insert_id . "adicionado.";
  } else {
    echo "erro: " . $conexao->error;
  }

  $conexao->close();
}

function exibirTombamentos() {
  global $conexao;

  $sql = "SELECT id, secretaria, tecnico, dataHora, prioridade, descricao FROM tombamentos";
  $resultado = $conexao->query($sql);

  $dadosTombamentos = [];

  if ($resultado->num_rows > 0) {
    // coloca cada linha de tombamentos do sql no array dadosTombamentos. 
    while($row = $resultado->fetch_assoc()) {
      $dadosTombamentos[] = $row;
    }
  }

  // transforma dadosTombamentos em formato JSON
  header('Content-Type: application/json');
  echo json_encode($dadosTombamentos);

  $conexao->close();
}