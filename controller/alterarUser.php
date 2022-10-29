<?php
    include_once("../model/conexao.php");
    include_once("../model/modelUser.php");
    
    extract($_REQUEST,EXTR_OVERWRITE);

    if (alterarUser())
    {
        header("Location: ../view/formAlterarUser.php?alterar=s");
    }
    else
    {
        header("Location: ../view/formAlterarUser.php?alterar=n");
    }

?>