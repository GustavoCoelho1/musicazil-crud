<?php
    include_once("../model/modelMusica.php");
    include_once("../model/conexao.php");

    extract($_REQUEST, EXTR_OVERWRITE);

    if (alterarMusica())
    {
        header("Location: ../view/formAlterarMusica.php?alterar=s");
    }
    else
    {
        header("Location: ../view/formAlterarMusica.php?alterar=n");
    }
?>