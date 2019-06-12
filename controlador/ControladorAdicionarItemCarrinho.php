<?php
    
    include_once('../modelo/BDFuncoes.php');
    $bdFuncoes = new BDFuncoes();

    session_start();

    $idProduto = $_GET["id"];

    $usuario = $_SESSION["usuario"];

    $qtd = $_GET["qtd"];

    if ($bdFuncoes->getQtdItem($idProduto) < $qtd){
        echo "<script>
        alert('Não há itens suficientes');
        window.location.href = '../index.php';
        </script>";
    } else {
        $msg = $bdFuncoes->inserirItemCarrinho($idProduto, $usuario, $qtd);
        echo "<script>
            alert('{$msg}');
            window.location.href = '../index.php';
            </script>";
    }
?>