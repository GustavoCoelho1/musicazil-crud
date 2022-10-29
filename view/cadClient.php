<?php include_once('header.php'); ?>

<link rel="stylesheet" href="./css/cadUser.css">
<link rel="stylesheet" href="./css/cadClient.css">
<link rel="stylesheet" href="./css/cadMsg.css">


<?php 
    if (isset($_GET['inserir']))
    {
        if ($_GET['inserir'] == 's')
        {?>
           <div class="cad_msgLyt">
                <div class="cad_msgSucesso">
                    <div class="cad_bordaCinza">
                        <h1> Sucesso! </h1>
                        <span> O cadastro de Cliente foi realizado com sucesso!</span> 
                    </div>
                </div>

                <a style="text-decoration: none;" href="viewTudoClient.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
            <div> 
        <?php
        }
        else
        {?>
            <div class="cad_msgLyt">
                 <div class="cad_msgErro">
                     <div class="cad_bordaCinza">
                         <h1> Erro! </h1>
                         <span> Algo deu errado durante o cadastro do Cliente!</span> 
                     </div>
                 </div>

                 <a style="text-decoration: none;" href="cadUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Tentar Novamente </button> </a>
             <div> 
         <?php
        }
    }
    else
    {
?>

<div class= "cadUser_layout">
    <form class="row" method="POST" action="../controller/inserirPessoa.php">
        <h1 style="text-align: center; margin-bottom: 20px"> Cadastrar </h1>

        <div class="col-md-8">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input type="text" name="txt_Nome" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Data de Nascimento</label>
            <input type="date" name="dt_DtNasc" class="form-control" id="inputPassword4">
        </div>

        <div class="col-12">
            <label for="inputAddress" class="form-label" style="margin-top: 5px!important;">Número de telefone</label>
            <input type="text" name="txt_Tel" class="form-control" maxlength="11" placeholder="(00) 00000-0000">
        </div>

        <!-- <div style="margin-top: 10px" class="col-12">
            <input type="checkbox" name="chk_Artista" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Artista</label>
        </div> -->

        <input type="hidden" name="txt_Email" value="<?= $_POST['txt_Email']?>">
        <input type="hidden" name="txt_NomeUser" value="<?= $_POST['txt_NomeUser']?>">
        <input type="hidden" name="txt_Senha" value="<?= $_POST['txt_Senha']?>">

        <div class="col-12">
            <center> <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>

<?php
    }
?>

<?php include_once('footer.php'); ?>