<?php 
include_once('header.php'); 
include_once('../model/conexao.php');
include_once('../model/modelUser.php');
include_once('../model/modelMusica.php');
?>


<link rel="stylesheet" href="./css/cadUser.css">
<link rel="stylesheet" href="./css/cadMusica.css">
<link rel="stylesheet" href="./css/cadMsg.css">

<?php
if (isset($_GET['alterar']))
{
    if ($_GET['alterar'] == 's')
    {?>
        <div class="cad_msgLyt">
            <div class="cad_msgSucesso">
                <div class="cad_bordaCinza">
                    <h1> Sucesso! </h1>
                    <span> O modificação da Música foi realizado com sucesso!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewTudoMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
        <div> 
    <?php
    }
    else if ($_GET['alterar'] == 'n')
    { ?>
        <div class="cad_msgLyt">
            <div class="cad_msgErro">
                <div class="cad_bordaCinza">
                    <h1> Erro! </h1>
                    <span> Algo deu errado durante a modificação da Música!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
        <div> 
        <?php 
    }
}
else 
{
    $musicaF = listarMusicaCodigo();
 	
    $musica = mysqli_fetch_assoc($musicaF);
    $usuarios = listarTudoUser();
?>

<div class="cadCenter">
    <div class= "cadMusicaLyt">
        <form method="POST" action="../controller/alterarMusica.php" enctype='multipart/form-data'>
            <h1> Alterar música </h1>

            <div class="cadMusicaPartes">
                <div class="cadMusicaPt1">
                    <img id="fotoCapa" class="cadMusicaFotoCapa" id="foto"/>
                    <div class="">
                        <label for="inputPassword4" class="form-label">Foto da Capa</label>
                        <input type="file" src="<?=$musica["Caminho Capa"]?>" name="fl_FotoCapa" class="form-control" id="foto" onchange="carregarFoto(event)">
                    </div>
                </div>
                
                <div class="divider"></div>

                <div class="cadMusicaPt2 row"> 
                    <div class="col-md-6">
                        <label class="form-label" for="exampleFormControlTextarea1">Código</label>
                        <input type="text" name="txt_CodMus" value="<?=$musica["Código"]?>" class="form-control" id="inputEmail4" placeholder="Nome de Usuário" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="exampleFormControlTextarea1">Artista</label>
                        <select id="txt_NomeUser" name="txt_NomeUser" class="form-select" onchange="validarCmb(this)" required>
                            <option value="" selected disabled>Selecione...</option>
                            <?php 
                                foreach($usuarios as $usuario)
                                {?>
                                    <option value="<?=$usuario['Nome de Usuário']?>" <?php echo ($usuario["Nome de Usuário"] == $musica["Artista"]) ?  " selected" : "" ?> disabled><?=$usuario['Nome de Usuário']?></option>
                                <?php }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Nome da música</label>
                        <input type="text" name="txt_NomeMus" value="<?=$musica["Nome"]?>" class="form-control" id="inputEmail4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Albúm da música</label>
                        <input type="text" name="txt_Album" value="<?=$musica["Álbum"]?>"class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label">Data de Lançamento</label>
                        <input type="date" name="dt_DataLanc" value="<?=converteData($musica["Data de Lançamento"])?>" class="form-control" id="inputPassword4">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Gênero</label>
                        <select id="cmb_Genero" name="cmb_Genero" class="form-select" onchange="validarCmb(this)" required>
                            <option value="" disabled>Selecione...</option>
                            <option <?php if($musica["Gênero"] == "Pop") echo "selected"?> value="Pop">POP</option>
                            <option <?php if($musica["Gênero"] == "Sertanejo") echo "selected"?> value="Sertanejo">Sertanejo</option>
                            <option <?php if($musica["Gênero"] == "Funk") echo "selected"?> value="Funk">Funk</option>
                            <option <?php if($musica["Gênero"] == "Rap") echo "selected"?> value="Rap">Rap</option>
                            <option <?php if($musica["Gênero"] == "MPB") echo "selected"?> value="MPB">MPB</option>
                            <option <?php if($musica["Gênero"] == "Rock") echo "selected"?> value="Rock">Samba</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Música</label>
                        <input type="file" files="url('<?=$musica["Caminho Música"]?>')" id="musica" name="fl_Musica" class="form-control" id="inputEmail4" onchange="showDuracao(event)">
                    </div>

                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Duração</label>
                        <input type="text" id="duracao" name="txt_Duracao" value="00:00:00" class="form-control" id="inputEmail4" placeholder="00:00" readonly> 
                    </div> 

                    <div class="col-md-12">
                        <label class="form-label" for="exampleFormControlTextarea1">Letra</label>
                        <textarea name="txt_Letra" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$musica["Letra"]?></textarea>
                    </div>
                </div> 
            </div>

            <div class="col-12">
                <center> <button style="margin-top: 20px" type="submit" class="btn btn-success">Alterar</button>
            </div>
        </form>
    </div>
</div>

<script src="js/cadMusica.js"></script>
<?php 
}
include_once('footer.php'); ?>