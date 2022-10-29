<?php
include_once("../model/conexao.php");
include_once("../model/modelClient.php");

extract($_REQUEST,EXTR_OVERWRITE);

if (deletarClient())
{
    header("Location: ../view/viewClient.php?excluir=s");
}
else
{
    header("Location: ../view/viewClient.php?excluir=n");
}
