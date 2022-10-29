<?php
    include_once("../model/conexao.php");
    include_once("../model/modelUser.php");
    
    extract($_REQUEST,EXTR_OVERWRITE);

    var_dump(deletarUser());

    if (deletarUser())
    {
        header("Location: ../view/viewUser.php?excluir=s");
    }
    else
    {
        header("Location: ../view/viewUser.php?excluir=n");
    }

?>