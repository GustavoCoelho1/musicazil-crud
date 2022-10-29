<?php include_once('header.php'); ?>

<link rel="stylesheet" href="./css/cadUser.css">
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
                        <span> O cadastro de Usuário foi realizado com sucesso!</span> 
                    </div>
                </div>

                <a style="text-decoration: none;" href="viewTudoUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
            <div> 
        <?php
        }
        else
        {?>
            <div class="cad_msgLyt">
                 <div class="cad_msgErro">
                     <div class="cad_bordaCinza">
                         <h1> Erro! </h1>
                         <span> Algo deu errado durante o cadastro do Usuário!</span> 
                     </div>
                 </div>

                 <a style="text-decoration: none;" href="cadUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
             <div> 
         <?php
        }
    }
    else
    {
?>

<div class= "cadUser_layout">
    <form method="POST" action="../view/cadClient.php">
        <h1 style="text-align: center; margin-bottom: 20px"> Cadastrar </h1>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome de Usuário</label>
            <input type="text" class="form-control" name="txt_NomeUser" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email de Usuário</label>
            <input type="email" class="form-control" name="txt_Email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" class="form-control" name="txt_Senha" id="exampleInputPassword1">
            <div id="emailHelp" class="form-text">Nunca compartilhe seus dados pessoais com ninguém</div>
        </div>
        <center> <button type="submit" class="btn btn-success">Próximo</button>
    </form>
</div>

<?php }
include_once('footer.php'); ?>