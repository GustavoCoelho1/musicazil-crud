<?php 
include_once("../model/conexao.php");
include_once("../model/modelClient.php");
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
                    <span> A exclusão de Cliente foi realizado com sucesso!</span> 
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
                <span> Algo deu errado durante a exclusão do Cliente!</span> 
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
    <form method="POST" action="viewClient.php" autocomplete="off">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button 
                <?php
                if (!isset($_POST["txt_ClientCod"]))
                {
                    echo(" collapsed");
                }
                ?>
                " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="
                <?php
                 if (isset($_POST["txt_ClientCod"]))
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
                if (isset($_POST["txt_ClientCod"]))
                {
                    echo(" show");
                }
            ?>
            " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="col-12 layoutText">
                    <label for="inputAddress" class="form-label">Código</label>
                    <input type="number" class="form-control" id="txt_ClientCod" name="txt_ClientCod" placeholder="1234" required>

                    <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="viewClient.php" autocomplete="off">
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
                        <label for="inputAddress" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="txt_Nome" name="txt_Nome" placeholder="Jose Augusto Exemplos" required>

                        <button type="submit" class="btn btn-success vu_btnBuscarCod">Buscar</button> 
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php   

if (isset($_POST["txt_ClientCod"]))
{
    $lista = listarClientCodigo();
}

if (isset($_POST["txt_Nome"]))
{
    $lista = listarClientNome();
}

if(isset($lista))
{
    if (mysqli_num_rows($lista) != 0)
    {
    ?>
        <table class="table center">
            <thead>
                <th> Código </th>
                <th style="text-align: left!important"> Nome </th>
                <th style="text-align: left!important"> Celular </th>
                <th> Artista </th>
                <th> Alterar </th>
                <th> Excluir </th>
            </thead>
        <?php
        

        foreach($lista as $cliente)
        { 
        ?>
            <tbody>
            <tr>
                <th> <?= $cliente["Código"] ?> </th>
                <td style="text-align: left!important"> <?= $cliente["Nome"] ?> </td>
                <td style="text-align: left!important"> <?= $cliente["Celular"] ?> </td>
                <td> <?= $cliente["Artista"] ?> </td>

                <td>
                    <form action="../view/formAlterarClient.php" method="POST">
                        <input type="hidden" name="txt_ClientCod" value="<?=$cliente['Código']?>">
                        <button type="submit" class="btn btn-success"> Alterar </button>
                    </form>
                </td>

                <td>
                    <form action="../controller/deletarClient.php" method="POST">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModel"> Excluir </button>

                        <div class="modal fade" id="exampleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    }

    else
    {
        if (isset($_POST["txt_ClientCod"]) || isset($_POST["txt_Nome"]))
        {
            $tipo = isset($_POST["txt_ClientCod"]) ? array("código", $_POST['txt_ClientCod']) : array("nome", $_POST['txt_Nome']);

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