<?php 
include_once("../model/conexao.php");
include_once("../model/modelUser.php");
include_once("header.php");
?>

<link rel="stylesheet" href="./css/viewTudoUser.css">
<div class="center">
    <div class="vtu_tableLyt">

        <?php
        $lista = listarTudoUser();

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
                    <th scope="col"> Nome de Usuário </th>
                    <th scope="col"> E-mail </th>
                <tr>
            </thead>

            <tbody>
                <?php
                    foreach ($lista as $usuario)
                    {?>
                        <tr>
                            <th scope='col'><?=$usuario["Código"]?></th>
                            <td scope='col'><?=$usuario["Nome de Usuário"]?></td>
                            <td scope='col'><?=$usuario["E-mail"]?></td>
                            <td>
                                <form action="../view/formAlterarUser.php" method="POST">
                                    <input type="hidden" name="txt_UserCod" value="<?=$usuario['Código']?>">
                                    <button type="submit" class="btn btn-success"> Alterar </button>
                                </form>
                            </td>

                            <td>
                                <form action="../controller/deletarUser.php" method="POST">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModel"> Excluir </button>

                                    <div class="modal fade" id="exampleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                Você tem certeza que deseja excluir o usuário: <br><br>

                                                <strong> Código: </strong> <?=$usuario["Código"]?> <br>
                                                <strong> Nome: </strong> <?=$usuario["Nome de Usuário"]?> <br>
                                                <strong> Email: </strong> <?=$usuario["E-mail"]?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>

                                                <input type="hidden" name="codDelete" value="<?=$usuario['Código']?>">
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
<?php 
        }
include_once("footer.php"); ?>