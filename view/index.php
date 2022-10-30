<?php 
include_once('header.php'); 
include_once('../model/conexao.php');
?>
 <?php 
$c = new Conexao();
$conexao = $c -> conectar();
?>
<script>
    alert("<?php if($conexao != false && $conexao != null) {echo'Conexão com o Banco de Dados OK! :D';} else echo'Conexão com o Banco de Dados falhou! :C';?>");
</script>

<link rel="stylesheet" href="./css/index.css">
<link rel="stylesheet" href="./css/cadUser.css">

<div class='indx_gifLyt'>
<img src='./imagens/MUSICAZIL.gif'>
</div>

<?php include_once('footer.php'); ?>

    