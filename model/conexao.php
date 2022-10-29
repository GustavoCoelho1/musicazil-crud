<?php
class Conexao
{
    public function conectar()
    {
        $usuario = "root";
        $url = "localhost";
        $senhaBD = ""; //Mudar aqui
        $nomeBancoDados = "db_musicazil"; //Mudar aqui

        $conexao = mysqli_connect($url, $usuario, $senhaBD, $nomeBancoDados);

        return $conexao;
    }
}
?>