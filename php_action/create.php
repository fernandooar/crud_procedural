<?php 
session_start();
require_once 'db_conect.php';

//Essa função previne contra ataques de SQL INJECTION e CROSS SITE SCRIPTING(AULAS 51)
function  clear($input){
    global $connect;
    $var = mysqli_escape_string($connect, $input);

    $var  = htmlspecialchars($var);

    return $var;
}

if(!empty($_POST['nome'])){
    $nome = clear($_POST['nome']);
    $sobrenome = clear($_POST['sobrenome']);
    $email = clear($_POST['email']);
    $idade = clear($_POST['idade']);

    $sql = "INSERT INTO clientes (nome, sobrenome, email, idade) VALUES ('$nome', '$sobrenome', '$email', '$idade')";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php');
    }else {
        //$_SESSION['mensagem'] = "Erro ao cadastrar.";
        //header('Location: ../adicionar.php');
    }
}else {
    $_SESSION['mensagem'] = "Erro ao cadastrar, os campos não podem ser vazios.";
    header('Location: ../adicionar.php');
}
?>