<?php
    include_once("../model/conexao.php");
    include_once("../model/modelClient.php");
    
    extract($_REQUEST,EXTR_OVERWRITE);

    if(alterarClient())
    {
        header("Location: ../view/formAlterarClient.php?alterar=s");
    }
    else
        header("Location: ../view/formAlterarClient.php?alterar=n");

?>