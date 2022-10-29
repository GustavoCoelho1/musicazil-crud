<?php 
include_once("../model/conexao.php");
include_once("../model/modelUser.php");
include_once("header.php");
?>

<link rel="stylesheet" href="./css/viewUser.css">
<link rel="stylesheet" href="./css/cadMsg.css">

<?php 
if (isset($_GET['excluir']))
{
    if (isset($_GET['excluir']) == 's')
    {?>
        <div class="cad_msgLyt">
            <div class="cad_msgSucesso">
                <div class="cad_bordaCinza">
                    <h1> Sucesso! </h1>
                    <span> A exclusão de Usuário foi realizado com sucesso!</span> 
                </div>
            </div>

            <a style="text-decoration: none;" href="viewTudoUser.php" class="cad_msgBtn"> <button type="button" class="btn btn-success"> Visualizar </button> </a>
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
                <span> Algo deu errado durante a exclusão do Usuário!</span> 
            </div>
        </div>

        <a style="text-decoration: none;" href="viewClient.php" class="cad_msgBtn"> <button type="button" class="btn btn-danger"> Tentar novamente </button> </a>
    <div> <?php 
    }
}
else
{
?>

<h1 class="vu_titulo"> Pesquisar </h1>

<div class="accordion" id="accordionExample">
    <form method="POST" action="viewUser.php" autocomplete="off">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button 
                <?php
                if (!isset($_POST["txt_UserCod"]))
                {
                    echo(" collapsed");
                }
                ?>
                " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="
                <?php
                 if (isset($_POST["txt_UserCod"]))
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
                if (isset($_POST["txt_UserCod"]))
                {
                    echo(" show");
                }
            ?>
            " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="col-12 layoutText">
                    <label for="inputAddress" class="form-label">Código</label>
                    <input type="number" class="form-control" id="txt_UserCod" name="txt_UserCod" placeholder="1234" required>

                    <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="viewUser.php" autocomplete="off">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button 
            <?php
                if (!isset($_POST["txt_UserEmail"]))
                {
                    echo(" collapsed");
                }
            ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="
            <?php
                 if (isset($_POST["txt_UserEmail"]))
                 {
                     echo("true");
                 }
                 else
                    echo("false");
            ?>
            " aria-controls="collapseTwo">
                Por E-mail
            </button>
            </h2>

            <div id="collapseTwo" class="accordion-collapse collapse
            <?php
                if (isset($_POST["txt_UserEmail"]))
                {
                    echo(" show");
                }
            ?>
            " aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="">
                    <div class="col-12 layoutText">
                        <label for="inputAddress" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="txt_UserEmail" name="txt_UserEmail" placeholder="email@exemplo.com" required>

                        <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button> 
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php   

if (isset($_POST["txt_UserCod"]))
{
    $lista = listarUserCodigo();
}

if (isset($_POST["txt_UserEmail"]))
{
    $lista = listarUserEmail();
}

if(isset($lista))
{
    if (mysqli_num_rows($lista) != 0)
    {
    ?>
        <table class="table center">
            <thead>
                <th> Código </th>
                <th style="text-align: left!important"> Nome de Usuário </th>
                <th style="text-align: left!important"> E-mail </th>
                <th> Alterar </th>
                <th> Excluir </th>
            </thead>
        <?php
        

        foreach($lista as $usuario)
        { 
        ?>
            <tbody>
            <tr>
                <th> <?= $usuario["Código"] ?> </th>
                <td style="text-align: left!important"> <?= $usuario["Nome de Usuário"] ?> </td>
                <td style="text-align: left!important"> <?= $usuario["E-mail"] ?> </td>

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
    }

    else
    {
        if (isset($_POST["txt_UserCod"]) || isset($_POST["txt_UserEmail"]))
        {
            $tipo = isset($_POST["txt_UserCod"]) ? array("código", $_POST['txt_UserCod']) : array("e-mail", $_POST['txt_UserEmail']);

            echo("<h5 style='text-align: center; margin-top: 20px;'>Pesquisa por: '$tipo[1]'</h5>");
            echo("<h3 style='text-align: center; margin-top: 10px;'> Não foram encontrados registros com esse $tipo[0]! </h3>");
        }
    }
}
?>
            </tbody>    
        </table>
<?php
    } 
?>
<?php include_once("footer.php");?>
