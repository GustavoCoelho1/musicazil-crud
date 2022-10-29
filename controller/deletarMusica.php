<?php
include_once("../model/conexao.php");
include_once("../model/modelMusica.php");

extract($_REQUEST,EXTR_OVERWRITE);

if (deletarMusica())
{
    header("Location: ../view/viewMusica.php?excluir=s");
}
else
{
    header("Location: ../view/viewMusica.php?excluir=n");
}
