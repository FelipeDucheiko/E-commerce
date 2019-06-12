<?php

    include_once('../modelo/BDFuncoes.php');
    $bdFuncoes = new BDFuncoes();


    $idProduto = $_GET["id"];

    $usuario = $_GET["usuario"];

    $msg = $bdFuncoes->DeletarItemCarrinho($idProduto, $usuario);

    echo "<script>
        window.location.href = '../carrinho.php';
        </script>";
?>