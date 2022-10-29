<?php 
session_start();
include_once('header.php');
include_once('../model/conexao.php');
include_once('../model/modelUser.php') ?>

<link rel="stylesheet" href="./css/cadUser.css">
<link rel="stylesheet" href="./css/cadMusica.css">
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
                        <span> Nova música inserida com sucesso!</span> 
                    </div>
                </div>

                <a style="text-decoration: none;" href="viewTudoMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
            <div> 
        <?php
        }
        else if (isset($_SESSION["userExiste"]) || isset($_SESSION["validarImg"]) || isset($_SESSION["validarMus"]))
        {?>
            <div class="cad_msgLyt">
                 <div class="cad_msgErro">
                     <div class="cad_bordaCinza">
                         <h1> Erro! </h1>
                         <span> Houve erros durante o cadastro da música:</span> 
                         <?php if (isset($_SESSION["userExiste"])) { if($_SESSION["userExiste"] == false) {?><p>O nome de usuário infomado não existe!</p> <?php }}?>
                         <?php if (isset($_SESSION["validarImg"])) { if($_SESSION["validarImg"] == false) {?><p>O tipo de imagem inserido não é suportado!</p> <?php }}?>
                         <?php if (isset($_SESSION["validarMus"])) { if($_SESSION["validarMus"] == false) {?><p>O tipo de música inserido não é suportado!</p> <?php }}?>
                     </div>
                 </div>

                 <a style="text-decoration: none;" href="cadMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
             <div> 
         <?php
        }
        else
        {?>
            <div class="cad_msgLyt">
                 <div class="cad_msgErro">
                     <div class="cad_bordaCinza">
                         <h1> Erro! </h1>
                         <span> Algo deu errado durante o cadastro da Música, tente novamente mais tarde!</span> 
                     </div>
                 </div>
             <div> 
        <?php
        }
    }
?>

<?php 
    $usuarios = listarTudoUser();
?>

<div class="cadCenter">
    <div class= "cadMusicaLyt">
        <form method="POST" action="../controller/inserirMusica.php" enctype='multipart/form-data'>
            <h1> Nova música </h1>

            <div class="cadMusicaPartes">
                <div class="cadMusicaPt1">
                    <img id="fotoCapa" class="cadMusicaFotoCapa" id="foto"/>
                    <div class="">
                        <label for="inputPassword4" class="form-label">Foto da Capa</label>
                        <input type="file" name="fl_FotoCapa" class="form-control" id="inputPassword4" onchange="carregarFoto(event)">
                    </div>
                </div>
                
                <div class="divider"></div>

                <div class="cadMusicaPt2 row"> 

                    <div class="col-md-12">
                        <label class="form-label" for="exampleFormControlTextarea1">Artista</label>
                        <select id="txt_NomeUser" name="txt_NomeUser" class="form-select" onchange="validarCmb(this)" required>
                            <option value="" selected disabled>Selecione...</option>
                            <?php 
                                foreach($usuarios as $usuario)
                                {?>
                                    <option value="<?=$usuario['Nome de Usuário']?>"><?=$usuario['Nome de Usuário']?></option>
                                <?php }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Nome da música</label>
                        <input type="text" name="txt_NomeMus" class="form-control" id="inputEmail4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Albúm da música</label>
                        <input type="text" name="txt_Album" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Data de Lançamento</label>
                        <input type="date" name="dt_DataLanc" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Gênero</label>
                        <select id="cmb_Genero" name="cmb_Genero" class="form-select" onchange="validarCmb(this)" required>
                            <option value="" selected disabled>Selecione...</option>
                            <option value="POP">POP</option>
                            <option value="Sertanejo">Sertanejo</option>
                            <option value="Funk">Funk</option>
                            <option value="Rap">Rap</option>
                            <option value="MPB">MPB</option>
                            <option value="Rock">Samba</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Música</label>
                        <input type="file" id="musica" name="fl_Musica" class="form-control" id="inputEmail4" onchange="showDuracao(event)">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Duração</label>
                        <input type="text" id="duracao" name="txt_Duracao" class="form-control" id="inputEmail4" placeholder="00:00" readonly> 
                    </div> 

                    <div class="col-md-12">
                        <label class="form-label" for="exampleFormControlTextarea1">Letra</label>
                        <textarea name="txt_Letra" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div> 
            </div>

            <div class="col-12">
                <center> <button style="margin-top: 20px" type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

<script src="js/cadMusica.js"></script>
<?php include_once('footer.php'); ?>