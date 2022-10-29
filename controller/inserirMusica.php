<?php
    include_once("../model/modelMusica.php");
    include_once("../model/conexao.php");

    extract($_REQUEST, EXTR_OVERWRITE);

    if (inserirMusicaBanco())
    {
        header("Location: ../view/cadMusica.php?inserir=s");
    }
    else
    {
        header("Location: ../view/cadMusica.php?inserir=n");
    }
?>