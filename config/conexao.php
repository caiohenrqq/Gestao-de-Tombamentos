<?php
$servidor = 'srv1660.hstgr.io';
$usuario = 'u978775537_admin';
$senha = 'h[#Ghen5|R8@' ;
$database = 'u978775537_tombamentos';

$conexao = new mysqli($servidor, $usuario, $senha, $database);

if ($conexao->connect_error) {
  echo ("falha na conexão! erro: ". $conexao->connect_error);
}