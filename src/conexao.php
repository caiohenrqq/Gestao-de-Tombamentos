<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = 'elsword123' ;
$database = 'tecnicos';

$conexao = new mysqli($servidor, $usuario, $senha, $database);

if ($conexao->connect_error) {
  die("falha na conexão! erro: ". $conexao->connect_error);
}