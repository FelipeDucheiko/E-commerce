<?php

    include_once('../modelo/BDFuncoes.php');
    $bdFuncoes = new BDFuncoes();
    
    $usuario = $_POST["usuario"] ?? null;
    $senha = $_POST["senha"] ?? null;

    session_start();

    if (isset($usuario)){

      if (!(strcmp($usuario,"") || strcmp($senha,""))){
        echo "<script>
        alert('Complete todos os campos.');
        window.location.href = '../login.php';
        </script>";
      }

      if ($bdFuncoes->confereUsuario($usuario, $senha)){
        $_SESSION['logado'] = "true";
        $_SESSION['usuario'] = $usuario;

        echo "<script>
        window.location.href = '../index.php';
        </script>";
        
      } else {
        echo "<script>
        alert('Usuário ou senha errados!');
        window.location.href = '../login.php';
        </script>";
      }
    }
?>