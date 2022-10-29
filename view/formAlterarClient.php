<?php include_once('header.php'); 
include_once('../model/conexao.php');
include_once('../model/modelClient.php');
extract($_REQUEST,EXTR_OVERWRITE);
?>

<link rel="stylesheet" href="./css/cadUser.css">
<link rel="stylesheet" href="./css/cadClient.css">
<link rel="stylesheet" href="./css/cadMsg.css">
<link rel="stylesheet" href="./css/formAlterar.css">

<?php
if (isset($_GET['alterar']))
{
    if ($_GET['alterar'] == 's')
    {?>
        <div class="cad_msgLyt">
            <div class="cad_msgSucesso">
                <div class="cad_bordaCinza">
                    <h1> Sucesso! </h1>
                    <span> O modificação de Cliente foi realizado com sucesso!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewTudoClient.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
        <div> 
    <?php
    }
    else
    { ?>
        <div class="cad_msgLyt">
            <div class="cad_msgErro">
                <div class="cad_bordaCinza">
                    <h1> Erro! </h1>
                    <span> Algo deu errado durante a modificação do Cliente!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewClient.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
        <div> 
        <?php 
    }
}
else 
{
    $lista = listarClientCodigo();
 	//PODE USAR COM FOREACH OU ESSE MÉTODO AQUI --> mysqli_fetch_assoc($lista)
    foreach($lista as $cliente)
    {
?>

<div class= "cadUser_layout">
    <form class="row" method="POST" action="../controller/alterarClient.php">
        <h1 style="text-align: center; margin-bottom: 20px"> Alterar Cliente </h1>

        <div class="">
            <label for="exampleInputEmail1" class="form-label">Código de Cliente</label>
            <input type="text" class="form-control" name="txt_Cod" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $cliente['Código']?>" disabled>
        </div>

        <div class="col-md-8">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input type="text" name="txt_Nome" class="form-control" id="inputEmail4" value="<?= $cliente['Nome']?>">
        </div>

        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Data de Nascimento</label>
            <input type="date" name="dt_DtNasc" class="form-control" id="inputPassword4" value="<?= converteData($cliente['Data de Nascimento'])?>">
        </div>

        <div class="col-12">
            <label for="inputAddress" class="form-label" style="margin-top: 5px!important;">Número de telefone</label>
            <input type="text" name="txt_Tel" class="form-control" maxlength="11" placeholder="(00) 00000-0000" value="<?= $cliente['Celular']?>">
        </div>

        <?php if ($cliente["Artista"] == "Sim")
        {?>
        <div class="col-12">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked disabled>
            <label class="form-check-label" for="exampleCheck1">Artista</label>
        </div>
        <?php
        }
        ?>

        <div class="col-12">
            <input type="hidden" name="codAlterar" value='<?=$_POST['codAlterar']?>'>
            <center> <button type="submit" class="btn btn-success">Alterar</button>
        </div>
    </form>
</div>

<?php }
}

include_once('footer.php'); ?>