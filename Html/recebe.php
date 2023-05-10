<?php
    require_once "index.php";
    @$nome = $_POST['nome'];
    echo $nome;
    @$acao = $_POST['acao'];
    echo $acao;
    @$nome = $_GET['nome'];
    echo $nome;
    @$acao = $_GET['acao'];
    echo $acao;


    if ($acao == 'inserir'){

    }else if($acao == 'editar'){

    }
?>