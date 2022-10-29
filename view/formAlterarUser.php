<?php 
include_once('../model/conexao.php');
include_once('../model/modelUser.php');
include_once('header.php');


extract($_REQUEST,EXTR_OVERWRITE);
?>

<link rel="stylesheet" href="./css/cadUser.css">
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
                    <span> O modificação de Usuário foi realizado com sucesso!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewTudoUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
        <div> 
    <?php
    }
    else
    { ?>
        <div class="cad_msgLyt">
            <div class="cad_msgErro">
                <div class="cad_bordaCinza">
                    <h1> Erro! </h1>
                    <span> Algo deu errado durante a modificação do Usuário!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
        <div> 
        <?php 
    } 
}
else
{
    $lista = listarUserCodigo();
    foreach($lista as $usuario)
    {
?>

<div class= "cadUser_layout">
    
    <form method="POST" action="../controller/alterarUser.php">

        <h1 style="text-align: center; margin-bottom: 20px"> Alterar Usuário </h1>

        <div class="">
            <label for="exampleInputEmail1" class="form-label">Código de Usuário</label>
            <input type="text" class="form-control" name="txt_Cod" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $usuario['Código']?>" disabled>
        </div>

        <div class="">
            <label for="exampleInputEmail1" class="form-label">Novo Nome de Usuário</label>
            <input type="text" class="form-control" name="txt_NovoNome" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $usuario['Nome de Usuário']?>" required>
        </div>

        <div class="">
            <label for="exampleInputEmail1" class="form-label">Novo Endereço de email</label>
            <input type="email" class="form-control" name="txt_NovoEmail" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $usuario['E-mail']?>" required>
        </div>

        <div class="">
            <label for="exampleInputPassword1" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" name="txt_NovaSenha" id="exampleInputPassword1" required>
        </div>

        <input type="hidden" name="codAlterar" value="<?=$_POST['txt_UserCod']?>">
        <center> <button type="submit" class="btn btn-success">Alterar</button>
    </form>
</div>

<?php }
}
include_once('footer.php'); ?>