<?php
    include_once("../model/modelPessoa.php");
    include_once("../model/conexao.php");

    extract($_REQUEST, EXTR_OVERWRITE);

    if (inserirPessoaBanco())
    {
        header("Location: ../view/cadUser.php?inserir=s");
    }
    else
    {
        header("Location: ../view/cadUser.php?inserir=n");
    }
?>