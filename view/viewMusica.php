<?php 
include_once("../model/conexao.php");
include_once("../model/modelMusica.php");
include_once("header.php");
?>

<link rel="stylesheet" href="./css/viewUser.css">
<link rel="stylesheet" href="./css/cadMsg.css">
<link rel="stylesheet" href="./css/viewTudoUser.css">
<link rel="stylesheet" href="./css/viewTudoMusica.css">
<link rel="stylesheet" href="./css/vtmModal.css">
<link rel="stylesheet" href="./css/vtmTable.css">

<?php 
if (isset($_GET['excluir']))
{
    if (isset($_GET['excluir']) == 's')
    {?>
        <div class="cad_msgLyt">
            <div class="cad_msgSucesso">
                <div class="cad_bordaCinza">
                    <h1> Sucesso! </h1>
                    <span> A exclusão da Música foi realizada com sucesso!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewTudoMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
        <div> 
    <?php
    }
    else
    {
    ?>
    <div class="cad_msgLyt">
        <div class="cad_msgErro">
            <div class="cad_bordaCinza">
                <h1> Erro! </h1>
                <span> Algo deu errado durante a exclusão da Música!</span> 
            </div>
        </div>

        <a style="text-decoration: none;" href="viewMusica.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
    <div> <?php 
    }
}
else
{
?>

<h1 class="vu_titulo prt"> Pesquisar </h1>

<div class="accordion" id="accordionExample">
    <form method="POST" action="viewMusica.php" autocomplete="off">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button 
                <?php
                if (!isset($_POST["txt_CodMus"]))
                {
                    echo(" collapsed");
                }
                ?>
                " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="
                <?php
                 if (isset($_POST["txt_CodMus"]))
                 {
                     echo("true");
                 }
                 else
                    echo("false");
                ?>
                " aria-controls="collapseOne">
                    Por código
                </button>
            </h2>

            <div id="collapseOne" class="accordion-collapse collapse
            <?php
                if (isset($_POST["txt_CodMus"]))
                {
                    echo(" show");
                }
            ?>
            " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="col-12 layoutText">
                    <label for="inputAddress" class="form-label prt">Código</label>
                    <input type="number" class="form-control" id="txt_ClientCod" name="txt_CodMus" placeholder="1234" required>

                    <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="viewMusica.php" autocomplete="off">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button 
            <?php
                if (!isset($_POST["txt_Nome"]))
                {
                    echo(" collapsed");
                }
            ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="
            <?php
                 if (isset($_POST["txt_Nome"]))
                 {
                     echo("true");
                 }
                 else
                    echo("false");
            ?>
            " aria-controls="collapseTwo">
                Por Nome
            </button>
            </h2>

            <div id="collapseTwo" class="accordion-collapse collapse
            <?php
                if (isset($_POST["txt_Nome"]))
                {
                    echo(" show");
                }
            ?>
            " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="">
                    <div class="col-12 layoutText">
                        <label for="inputAddress" class="form-label prt">Nome</label>
                        <input type="text" class="form-control" id="txt_Nome" name="txt_Nome" placeholder="Despacito" required>

                        <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button> 
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php   

if (isset($_POST["txt_CodMus"]))
{
    $lista = listarMusicaCodigo();
}

if (isset($_POST["txt_Nome"]))
{
    $lista = listarMusicaNome();
}

if(isset($lista))
{?>
    <div class="vm_center">
        <div class="vtu_tableLyt vtm">
            <?php
            if (mysqli_num_rows($lista) != 0)
            {?>
            <div class="vtm_titulo">
                <h1> Resultados </h1>
            </div>

            <div class="vtm_table">
                <div class="vtm_tableLinha">
                    <?php
                    $counter = 0;
                    $column = 0;
                    
                    foreach($lista as $musica)
                    {
                        $counter += 1;
                        $column += (float) 1.0;
                        ?>
                        <div class="vtm_tableContent"> 
                            <button type="button" class="vtm_musica" data-bs-toggle="modal" data-bs-target="#verMusica<?=$counter?>">
                                <div class="vtm_musicaFoto" style="background-image: url('<?=$musica['Caminho Capa']?>');"></div>

                                <div class="vtm_musicaInfo">
                                    <span class="vtm_musicaTitulo"> <?=$musica["Nome"]?> </span> 
                                    <span class="vtm_artista prt"> <?=$musica["Artista"]?> </span>
                                    <span class="vtm_album"> <img src="imagens/album.png"> <?=$musica["Álbum"]?> </span>
                                </div>
                            </button>

                            <div class="modal fade" id="verMusica<?=$counter?>" tabindex="-1" role="dialog" aria-labelledby="verMusica" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="vtm_modalLyt">
                                            <h6 class="vtm_modalArt prt"> Código: #<?= $musica["Código"]?> • <?=$musica["Artista"]?></h4>
                                            <h1 class="vtm_modalTitulo semi"> <?=$musica["Nome"]?></h1>
                                            <div class="vtm_imgBorda">
                                                <img class="vtm_modalImg" src="<?=$musica["Caminho Capa"]?>">
                                            </div>
                                            <span class="vtm_labelInfo prt">Gênero: <?=$musica["Gênero"]?> • Lançamento: <?=$musica["Data de Lançamento"]?></span>
                                            
                                            <span class="vtm_album prt" style="font-size: 11pt; margin-bottom: 7px; font-weight: normal"> <img style="width: 20px; height: 15px" src="imagens/album.png"> <?=$musica["Álbum"]?> </span>
                                            <audio controls  class="vtm_modelAudio vm">
                                                <source src="<?=$musica["Caminho Música"]?>" type="audio/mpeg">
                                            </audio>

                                            <span class="vtm_labelLetra semi">Letras</span>
                                            <div class="vtm_modelTxtArea prt" class="form-control" disabled>
                                                <h6 style="white-space:pre-wrap;"> <?=$musica["Letra"]?> </h6>
                                            </div>

                                            <div class="vtm_modalBotoes">
                                                <form class="vtm_btnAlt" action="../view/formAlterarMusica.php" method="POST">
                                                    <input type="hidden" name="txt_CodMus" value="<?=$musica['Código']?>">
                                                    <button type="submit" class="btn btn-success"> Alterar </button>
                                                </form>
                                            
                                                
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir<?=$counter?>"> Excluir </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalExcluir<?=$counter?>" tabindex="-2" role="dialog" aria-labelledby="modalExcluir" aria-hidden="true">
                            <form action="../controller/deletarMusica.php" method="POST">
                                <input type="hidden" name="txt_CodMus" value="<?=$musica['Código']?>">

                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Excluir Música</h5>
                                    </div>

                                    <div class="modal-body">
                                        Você tem certeza que deseja excluir a música: <br><br>

                                        <strong> Código: </strong> <?=$musica["Código"]?> <br>
                                        <strong> Nome: </strong> <?=$musica["Nome"]?> <br>
                                        <strong> Artista: </strong> <?=$musica["Artista"]?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>

                                        <input type="hidden" name="codDelete" value="<?=$musica['Código']?>">
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                            if($column % 2.0 == 0)
                            {
                                echo ('</div> <div class="vtm_tableLinha">');
                                $column = 0;
                            }
                    }   ?>
                </div>
            </div>
            <?php
                }
                else
                {
                    if (isset($_POST["txt_CodMus"]) || isset($_POST["txt_Nome"]))
                    {
                        $tipo = isset($_POST["txt_CodMus"]) ? array("código", $_POST['txt_CodMus']) : array("nome", $_POST['txt_Nome']);

                        echo("<h5 style='text-align: center; margin-top: 20px;'>Pesquisa por: '$tipo[1]'</h5>");
                        echo("<h3 style='text-align: center; margin-top: 10px;'> Não foram encontrados registros com esse $tipo[0]! </h3>");
                    }
                }?>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
}
?>

<?php include_once("footer.php");?>