<?php
include('protecao.php');
include "../config/conexao.php";

// lógica para pegar dados do formulário cadastro tombamentos
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

$sqlExibir = "SELECT * FROM tombamentos ORDER BY entrada DESC";
$resultadoTombamentos = $conexao->query($sqlExibir);

?>
