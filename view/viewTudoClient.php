<?php 
include_once("../model/conexao.php");
include_once("../model/modelClient.php");
include_once("header.php");
?>

<link rel="stylesheet" href="./css/viewTudoUser.css">

<div class="center">
    <div class="vtu_tableLyt">

        <?php
        $lista = listarTudoClient();

        if (mysqli_num_rows($lista) == 0)
        {
            echo('<h1 style="text-align: center; margin: 10px;"> Não há registros no banco! </h1>');
        }
        else
        {?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> Código </th>
                    <th scope="col"> Nome </th>
                    <th scope="col"> Data de Nascimento </th>
                    <th scope="col"> Número de Celular </th>
                    <th scope="col" style="text-align: center;"> Artista </th>
                    <th scope="col" style="text-align: center;"> Alterar </th>
                    <th scope="col" style="text-align: center;"> Excluir </th>
                <tr>
            </thead>

            <tbody>
                <?php
                    foreach ($lista as $cliente)
                    {?>
                    
                        <tr>
                            <th scope='col'><?=$cliente["Código"]?></th>
                            <td scope='col'><?=$cliente["Nome"]?></td>
                            <td scope='col'><?=$cliente["Data de Nascimento"]?></td>
                            <td scope='col'><?=$cliente["Celular"]?></td>
                            <td scope='col' style="text-align: center;"><?=$cliente["Artista"]?></td>

                            <td>
                                <center>
                                <form action="../view/formAlterarClient.php" method="POST">
                                    <input type="hidden" name="txt_ClientCod" value="<?=$cliente['Código']?>">
                                    <button type="submit" class="btn btn-success"> Alterar </button>
                                </form>
                                </center>
                            </td>

                            <td>
                                <form action="../controller/deletarClient.php" method="POST">
                                    <center>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir"> Excluir </button>

                                    </center>
                                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Pessoa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            Você tem certeza que deseja excluir o cliente: <br><br>

                                            <strong> Código: </strong> <?=$cliente["Código"]?> <br>
                                            <strong> Nome: </strong> <?=$cliente["Nome"]?> <br>
                                            <strong> Data de Nascimento: </strong> <?=$cliente["Data de Nascimento"]?>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>

                                            <input type="hidden" name="codDelete" value="<?=$cliente['Código']?>">
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php }
include_once("footer.php"); ?>