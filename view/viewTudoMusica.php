<?php 
include_once("../model/conexao.php");
include_once("../model/modelMusica.php");
include_once("header.php");
?>

<link rel="stylesheet" href="./css/viewTudoUser.css">
<link rel="stylesheet" href="./css/viewTudoMusica.css">
<link rel="stylesheet" href="./css/vtmModal.css">
<link rel="stylesheet" href="./css/vtmTable.css">

<div class="center">
    <div class="vtu_tableLyt vtm">

        <?php
        $lista = listarTudoMusica();

        if (mysqli_num_rows($lista) == 0)
        {
            echo('<h1 style="text-align: center; margin: 10px;"> Não há registros no banco! </h1>');
        }
        else
        {?>
        <div class="vtm_titulo">
            <h1> Músicas </h1>
        </div>

        <div class="vtm_table">
            <div class="vtm_tableLinha">
            <?php
                $counter = 0;
                $column = 0;
                
                foreach ($lista as $musica)
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

                }
            ?>
        </div>
    </div>
</div>
<?php }
include_once("footer.php"); ?>