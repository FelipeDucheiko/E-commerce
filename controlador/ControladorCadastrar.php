<?php

    include_once('../modelo/BDFuncoes.php');
    $bdFuncoes = new BDFuncoes();

    session_start();
    session_destroy();
    
    $nome = $_POST["nome"] ?? null;
    $sobrenome = $_POST["sobrenome"] ?? null;
    $dataNascimento = $_POST["dataNascimento"] ?? null;
    $email = $_POST["email"] ?? null;
    $senha = $_POST["senha"] ?? null;
    $endereço = $_POST["endereço"] ?? null;
    $cidade = $_POST["cidade"] ?? null;
    $cpf = $_POST["cpf"] ?? null;
    $cep = $_POST["cep"] ?? null;
    $telefone = $_POST["telefone"] ?? null;
    $sexo = $_POST["sexo"] ?? null;

    if ($nome == "" || $sobrenome == "" || $dataNascimento == "" || $email == "" || $senha == "" || $endereço == "" || $cidade == "" || $cpf == "" || $cep == "" || $telefone == "" || $sexo == "") {
      echo "<script>
        alert('Prencha todos os campos');
        window.location.href = '../login.php';
        </script>";
    }

    $msg = $bdFuncoes->inserirUsuario($nome, $sobrenome, $dataNascimento, $email, $senha, $endereço, $cidade, $cpf, $cep, $telefone, $sexo);

    echo "<script>
        alert('{$msg}');
        window.location.href = '../login.php';
        </script>";
    
?>