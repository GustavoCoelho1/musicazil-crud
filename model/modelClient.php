<?php
  include_once('model.php');

  function listarTudoClient()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();

    $resultado = $conexao-> query("SELECT Id_Clie AS 'Código', Nome_Clie AS 'Nome', DATE_FORMAT(Dt_Nasc, '%d/%m/%Y') AS 'Data de Nascimento', Fone_Clie AS 'Celular', IF(Artista = 'S', 'Sim', 'Não') AS 'Artista' FROM tb_cliente");
    
    return $resultado;
  }

  function listarClientCodigo()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();

    $cod = $_POST["txt_ClientCod"];

    $resultado = $conexao -> query("SELECT Id_Clie AS 'Código', Nome_Clie AS 'Nome', DATE_FORMAT(Dt_Nasc, '%d/%m/%Y') AS 'Data de Nascimento', Fone_Clie AS 'Celular', IF(Artista = 'S', 'Sim', 'Não') AS 'Artista' FROM tb_cliente WHERE Id_Clie = '{$cod}'");

    return $resultado;
  }
  
  function listarClientNome()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();

    $nome = $_POST["txt_Nome"];

    $resultado = $conexao -> query("SELECT Id_Clie AS 'Código', Nome_Clie AS 'Nome', DATE_FORMAT(Dt_Nasc, '%d/%m/%Y') AS 'Data de Nascimento', Fone_Clie AS 'Celular', IF(Artista = 'S', 'Sim', 'Não') AS 'Artista' FROM tb_cliente WHERE Nome_Clie LIKE '%{$nome}%'");

    return $resultado;
  }

  function deletarClient()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conexao -> autocommit(false);
    $conexao -> begin_transaction();
    try
    {
      $cod = $_POST["codDelete"];

      $conexao -> autocommit(false);

      $artF = $conexao -> query("SELECT Artista, Id_Artis as 'Código' FROM tb_cliente as clie INNER JOIN tb_artista as art ON art.Id_Clie_fk = clie.Id_Clie WHERE Id_Clie = '{$cod}'");
      $art = mysqli_fetch_assoc($artF);

      echo("<br>É artista? R: ".$art["Artista"]."<br>");

      if($art["Artista"] == "S")
      {
        $idArt = $art["Código"];
        $artTemMusicas = $conexao -> query("SELECT art.Id_Artis, mus.Id_Mus FROM tb_musica AS mus INNER JOIN tb_artista AS art ON mus.Id_Artis_fk = art.Id_Artis WHERE art.Id_Artis = '{$idArt}'");
        if (mysqli_num_rows($artTemMusicas) > 0)
        {
          foreach($artTemMusicas as $artMusica) //Se o artista possuir músicas
          {
          $idMus = $artMusica["Id_Mus"];
          $conexao -> query("DELETE FROM tb_musica WHERE Id_Mus = '{$idMus}'"); //Deletar todas as músicas desse artista
          }
        }
        $conexao -> query("DELETE FROM tb_artista WHERE Id_Artis = ".$art["Código"]); //Deletar artista
      }

      $conexao -> query("DELETE FROM tb_cliente WHERE Id_Clie = '{$cod}'");

      $conexao -> query("DELETE FROM tb_usuario WHERE Id_Usua = '{$cod}'");

      $resultado = $conexao -> commit();

      zerarUserIncrement();

      return $resultado;
    }
    catch (mysqli_sql_exception $exception) 
    {
      $conexao -> rollback();
      throw $exception;
    }
  }

  function alterarClient()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conexao -> autocommit(false);
    $conexao -> begin_transaction();
    try
    {
    $nome = $_POST["txt_Nome"];
    $dtNasc = $_POST["dt_DtNasc"];
    $fone = $_POST["txt_Tel"];
    $idClie = $_POST['codAlterar'];
    $artista = (isset($_POST["chk_Artista"])) ? "S" : "N";

    $conexao -> query("UPDATE tb_cliente SET Nome_Clie = '{$nome}', Dt_Nasc = '{$dtNasc}', Fone_Clie = '{$fone}', Artista = '{$artista}' where Id_Clie = '{$idClie}'");
/*
------------------------------
MODELO EM QUE O USUÁRIO ALTERA ENTRE SER ARTISTA OU NÃO, E CASO ELE DEIXE DE SER ARTISTA TODOS OS REGISTROS DELE E DE SUAS MÚSICAS SÃO EXCLUIDOS
------------------------------

  $idClie = $_POST['codAlterar'];
    $existeArt = $conexao -> query("SELECT * from tb_artista where Id_Clie_fk = '{$idClie}'");

    if ($artista == "S")
    {
      if (mysqli_num_rows($existeArt) == 0) //Se o Cliente não era artista antes da alteração
      {
        $conexao -> query("insert into tb_artista(Id_Clie_fk) values('{$idClie}')");
      }
    }
    else if ($artista == "N")
    {
      if (mysqli_num_rows($existeArt) > 0) //Se o Cliente já for artista antes da alteração
      {
        $artista = mysqli_fetch_assoc($existeArt);
        $idArt = $artista["Id_Artis"];
        $artTemMusicas = $conexao -> query("SELECT art.Id_Artis, mus.Id_Mus FROM tb_musica AS mus INNER JOIN tb_artista AS art ON mus.Id_Artis_fk = art.Id_Artis WHERE art.Id_Artis = '{$idArt}'");
        if (mysqli_num_rows($artTemMusicas) > 0)
        {
          foreach($artTemMusicas as $artMusica) //Se o artista possuir músicas
          {
            $idMus = $artMusica["Id_Mus"];
            $conexao -> query("DELETE FROM tb_musica WHERE Id_Mus = '{$idMus}'"); //Deletar todas as músicas desse artista
          }

          $conexao -> query("DELETE FROM tb_artista WHERE Id_Artis = ".$artista["Id_Artis"]); //Deletar artista
        }
      }
    }
*/
    $resultado = $conexao -> commit();

    return $resultado;
    }
    catch (mysqli_sql_exception $exception) 
    {
      $conexao -> rollback();
      throw $exception;
    }
  }
?>