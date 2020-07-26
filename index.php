<?php

require_once("config.php");

/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

// carrega um usuario 
//$root = new Usuario();
//$root->loadbyId(3);
//echo $root;

// Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("jo");
//echo json_encode($search);

// Carrega um usuario usuando o login e a senha
//$usuario = new Usuario();
//$usuario->login("root","#@!$");
//echo $usuario;

// inserindo um usuario na base
//$aluno = new Usuario();
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("@lnu0");
//$aluno->insert();
//echo $aluno;

//Ou criar metodo construct
//$aluno = new Usuario("aluno1","@xxxx1");
//$aluno->insert();
//echo $aluno;

//Fazendo update
//$usuario = new Usuario();
//$usuario->loadbyId(7);
//$usuario->update("professor","%4566s#");
//echo $usuario;

//Excluindo um usuario
$usuario = new Usuario();
$usuario->loadbyId(7);
$usuario->delete();
echo $usuario;

?>