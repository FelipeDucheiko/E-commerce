<?php

    include_once('../modelo/BDFuncoes.php');
    $bdFuncoes = new BDFuncoes();

    session_start();

    $bdFuncoes->comprarItensUsuario($_SESSION["usuario"]);

    echo "<script>
            alert('Compra realizada com sucesso');
            window.location.href = '../index.php';
            </script>";
?>