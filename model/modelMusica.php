<?php session_start();
include_once('model.php');

function inserirMusicaBanco()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $c = new Conexao();
    $conexao = $c -> conectar();
    $conexao -> autocommit(false);

    $conexao -> begin_transaction();
    try
    {
      $musicaNome = $_POST["txt_NomeMus"];
      $album = $_POST["txt_Album"];
      $dtLanc = $_POST["dt_DataLanc"];
      $genero = $_POST["cmb_Genero"];
      $duracao = $_POST["txt_Duracao"];
      $letra = $_POST["txt_Letra"];
      $nomeUser = $_POST["txt_NomeUser"];

      $usuarioF = $conexao -> query("SELECT Nome_Usua AS 'Nome' FROM tb_usuario WHERE Nome_Usua = '{$nomeUser}'");

      $_SESSION["userExiste"] = false;

      $usuario = mysqli_fetch_assoc($usuarioF);
      if ($usuario["Nome"] == $nomeUser)
      {
        $_SESSION["userExiste"] = true;
      }
      else
      {
        $_SESSION["userExiste"] = false;
        return false;
      }
      
      /*INÍCIO - Validar e Salvar Foto de Capa*/
        $foto = $_FILES["fl_FotoCapa"];
        $extFoto = array("png", "jpg", "jpeg");

        $nomeFoto = $foto["name"];
        $arrayFoto = explode('.', $nomeFoto);

        $extCerta = false;
        $ext = count($arrayFoto) - 1;

        for ($x = 0; $x <= count($extFoto) - 1; $x++)
        {
          if ($arrayFoto[$ext] == $extFoto[$x])
          {
            $extCerta = true;
          }
        }

        $_SESSION["validarImg"] = false;

        if ($extCerta == false)
        {
          $_SESSION["validarImg"] = false;
          return false;
        }
        else
        {
          $_SESSION["validarImg"] = true;

          $caminhoFoto = "../capaMusicas/".$nomeFoto;
          move_uploaded_file($foto["tmp_name"], $caminhoFoto);
        }
      /*FIM - Validar e Salvar Foto de Capa*/

      /*INÍCIO - Validar e Salvar Música*/
        $musica = $_FILES["fl_Musica"];
        $extMus = array("mp3", "wav", "wma");

        $nomeMus = $musica["name"];
        $arrayMus = explode('.', $nomeMus);

        $extCerta = false;
        $ext = count($arrayMus) - 1;

        for ($x = 0; $x <= count($extMus) - 1; $x++)
        {
          if ($arrayMus[$ext] == $extMus[$x])
          {
            $extCerta = true;
          }
        }

        $_SESSION["validarMus"] = false;

        if ($extCerta == false)
        {
          $_SESSION["validarMus"] = false;
          return false;
        }
        else
        {
          $_SESSION["validarMus"] = true;

          $caminhoMus = "../musicas/".$nomeMus;
          move_uploaded_file($musica["tmp_name"], $caminhoMus);
        }
      /*FIM - Validar e Salvar Música*/

      $codF = $conexao -> query("SELECT usua.Id_Usua, clie.Id_Clie, clie.Artista FROM tb_usuario AS usua INNER JOIN tb_cliente AS clie ON usua.Id_Usua = clie.Id_Usua_fk WHERE Nome_Usua = '{$nomeUser}';");

      $cod = mysqli_fetch_assoc($codF);

      if ($cod["Artista"] == "N")
      {
        $ClieId = $cod["Id_Clie"];
        $conexao -> query("UPDATE tb_cliente SET Artista = 'S' WHERE Id_Clie = '{$ClieId}';");
        $conexao -> query("INSERT INTO tb_artista(Id_Clie_fk) VALUES('{$ClieId}');");
        $ArtId = $conexao -> insert_id;
      }

      else if ($cod["Artista"] == "S")
      {
        $idArtF = $conexao -> query("SELECT art.Id_Artis FROM tb_usuario AS usua INNER JOIN tb_cliente AS clie ON usua.Id_Usua = clie.Id_Usua_fk INNER JOIN tb_artista AS art ON art.Id_Clie_fk = clie.Id_Clie WHERE Nome_Usua = '{$nomeUser}';");
        $idArt = mysqli_fetch_assoc($idArtF);
        $ArtId = $idArt["Id_Artis"];
      }

      if (strpos($letra, "'") == true)
      {
        $letra = str_replace("'", "\'", $letra);
      }

      if (strpos($letra, `"`) == true)
      {
        str_replace(`"`, `\"`, $letra);
      }

      $conexao -> query("INSERT INTO tb_musica(Nome_Mus, Genero_Mus, Album_Mus, Duracao_Mus, Link_Mus, Capa_Mus, Data_Lança_Mus, Letra_Mus, Id_Artis_fk) VALUES('{$musicaNome}', '{$genero}', '{$album}', '{$duracao}', '{$caminhoMus}', '{$caminhoFoto}', '{$dtLanc}', '{$letra}', '{$ArtId}');");

      $resultado  = $conexao -> commit();

      return $resultado;
    }
    catch (mysqli_sql_exception $exception) 
    {
      $conexao -> rollback();
      throw $exception;
    }
  }

  function listarTudoMusica()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $c = new Conexao();
    $conexao = $c -> conectar();

    $resultado = $conexao -> query("SELECT mus.Id_Mus as 'Código', mus.Nome_Mus as 'Nome', user.Nome_Usua as 'Artista', mus.Genero_Mus as 'Gênero', mus.Album_Mus as 'Álbum', mus.Duracao_Mus as 'Duração', DATE_FORMAT(mus.Data_Lança_Mus, '%d/%m/%Y') as 'Data de Lançamento', mus.Link_Mus as 'Caminho Música', mus.Capa_Mus as 'Caminho Capa', mus.Letra_Mus as 'Letra'
    FROM tb_musica as mus 
    INNER JOIN tb_artista as art 
    ON mus.Id_Artis_fk = art.Id_Artis 
    INNER JOIN tb_cliente as clie 
    ON art.Id_Clie_fk = clie.Id_Clie 
    INNER JOIN tb_usuario as user 
    ON clie.Id_Usua_fk = user.Id_Usua ;");

    return $resultado;
  }

  function listarMusicaCodigo()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $c = new Conexao();
    $conexao = $c -> conectar();

    $cod = $_POST["txt_CodMus"];

    $resultado = $conexao -> query("SELECT mus.Id_Mus as 'Código', mus.Nome_Mus as 'Nome', user.Nome_Usua as 'Artista', mus.Genero_Mus as 'Gênero', mus.Album_Mus as 'Álbum', mus.Duracao_Mus as 'Duração', mus.Link_Mus as 'Caminho Música', mus.Capa_Mus as 'Caminho Capa', DATE_FORMAT(mus.Data_Lança_Mus, '%d/%m/%Y') as 'Data de Lançamento', mus.Letra_Mus as 'Letra'
    FROM tb_musica as mus 
    INNER JOIN tb_artista as art 
    ON mus.Id_Artis_fk = art.Id_Artis 
    INNER JOIN tb_cliente as clie 
    ON art.Id_Clie_fk = clie.Id_Clie 
    INNER JOIN tb_usuario as user 
    ON clie.Id_Usua_fk = user.Id_Usua 
    WHERE mus.Id_Mus = '{$cod}';");

    return $resultado;
  }

  function listarMusicaNome()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $c = new Conexao();
    $conexao = $c -> conectar();

    $nome = $_POST["txt_Nome"];

    $resultado = $conexao -> query("SELECT mus.Id_Mus as 'Código', mus.Nome_Mus as 'Nome', user.Nome_Usua as 'Artista', mus.Genero_Mus as 'Gênero', mus.Album_Mus as 'Álbum', mus.Duracao_Mus as 'Duração', mus.Link_Mus as 'Caminho Música', mus.Capa_Mus as 'Caminho Capa', DATE_FORMAT(mus.Data_Lança_Mus, '%d/%m/%Y') as 'Data de Lançamento', mus.Letra_Mus as 'Letra'
    FROM tb_musica as mus 
    INNER JOIN tb_artista as art 
    ON mus.Id_Artis_fk = art.Id_Artis 
    INNER JOIN tb_cliente as clie 
    ON art.Id_Clie_fk = clie.Id_Clie 
    INNER JOIN tb_usuario as user 
    ON clie.Id_Usua_fk = user.Id_Usua 
    WHERE mus.Nome_Mus LIKE '%{$nome}%';");

    return $resultado;
  }

  function deletarMusica()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();

    $cod = $_POST["codDelete"];

    $resultado = $conexao -> query("DELETE FROM tb_musica WHERE Id_Mus = '{$cod}'");

    zerarMusIncrement();

    return $resultado;
  }

  function alterarMusica()
  {
    $c = new Conexao();
    $conexao = $c -> conectar();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conexao -> autocommit(false);
    $conexao -> begin_transaction();
    try
    {
      $musicaNome = $_POST["txt_NomeMus"]; 
      $album = $_POST["txt_Album"]; 
      $dtLanc = $_POST["dt_DataLanc"]; 
      $genero = $_POST["cmb_Genero"]; 
      $duracao = $_POST["txt_Duracao"]; 
      $letra = $_POST["txt_Letra"]; 
      $nomeUser = $_POST["txt_NomeUser"]; 
      $idMus = $_POST["txt_CodMus"]; 

      $usuarioF = $conexao -> query("SELECT Nome_Usua AS 'Nome' FROM tb_usuario WHERE Nome_Usua = '{$nomeUser}'");

      $_SESSION["userExiste"] = false;

      $usuario = mysqli_fetch_assoc($usuarioF);
      if ($usuario["Nome"] == $nomeUser)
      {
        $_SESSION["userExiste"] = true;
      }
      else
      {
        $_SESSION["userExiste"] = false;
        return false;
      }

      /*INÍCIO - Validar e Salvar Foto de Capa*/ 
      $foto = $_FILES["fl_FotoCapa"];
      $extFoto = array("png", "jpg", "jpeg");

      $nomeFoto = $foto["name"];
      $arrayFoto = explode('.', $nomeFoto);

      $extCerta = false;
      $ext = count($arrayFoto) - 1;

      for ($x = 0; $x <= count($extFoto) - 1; $x++)
      {
        if ($arrayFoto[$ext] == $extFoto[$x])
        {
          $extCerta = true;
        }
      }

      $_SESSION["validarImg"] = false;

      if ($extCerta == false)
      {
        $_SESSION["validarImg"] = false;
        return false;
      }
      else
      {
        $_SESSION["validarImg"] = true;

        $caminhoFoto = "../capaMusicas/".$nomeFoto;
        move_uploaded_file($foto["tmp_name"], $caminhoFoto);
      }
    /*FIM - Validar e Salvar Foto de Capa*/

    /*INÍCIO - Validar e Salvar Música*/
      $musica = $_FILES["fl_Musica"];
      $extMus = array("mp3", "wav", "wma");

      $nomeMus = $musica["name"];
      $arrayMus = explode('.', $nomeMus);

      $extCerta = false;
      $ext = count($arrayMus) - 1;

      for ($x = 0; $x <= count($extMus) - 1; $x++)
      {
        if ($arrayMus[$ext] == $extMus[$x])
        {
          $extCerta = true;
        }
      }

      $_SESSION["validarMus"] = false;

      if ($extCerta == false)
      {
        $_SESSION["validarMus"] = false;
        return false;
      }
      else
      {
        $_SESSION["validarMus"] = true;

        $caminhoMus = "../musicas/".$nomeMus;
        move_uploaded_file($musica["tmp_name"], $caminhoMus);
      }
      /*FIM - Validar e Salvar Música*/

      $codF = $conexao -> query("SELECT usua.Id_Usua, clie.Id_Clie, clie.Artista FROM tb_usuario AS usua INNER JOIN tb_cliente AS clie ON usua.Id_Usua = clie.Id_Usua_fk WHERE Nome_Usua = '{$nomeUser}';");

      $cod = mysqli_fetch_assoc($codF);

      if ($cod["Artista"] == "N")
      {
        $ClieId = $cod["Id_Clie"];
        $conexao -> query("UPDATE tb_cliente SET Artista = 'S' WHERE Id_Clie = '{$ClieId}';");
        $conexao -> query("INSERT INTO tb_artista(Id_Clie_fk) VALUES('{$ClieId}');");
        $idArt = $conexao -> insert_id;
      }

      else if ($cod["Artista"] == "S")
      {
        $idArtF = $conexao -> query("SELECT art.Id_Artis FROM tb_usuario AS usua INNER JOIN tb_cliente AS clie ON usua.Id_Usua = clie.Id_Usua_fk INNER JOIN tb_artista AS art ON art.Id_Clie_fk = clie.Id_Clie WHERE Nome_Usua = '{$nomeUser}';");
        $idArt = mysqli_fetch_assoc($idArtF);
        $idArt = $idArt["Id_Artis"];
      }

      if (strpos($letra, "'") == true)
      {
        $letra = str_replace("'", "\'", $letra);
      }

      if (strpos($letra, `"`) == true)
      {
        str_replace(`"`, `\"`, $letra);
      }

      $conexao -> query("UPDATE tb_musica SET Nome_Mus = '{$musicaNome}', Genero_Mus = '{$genero}', Album_Mus = '{$album}', Duracao_Mus = '{$duracao}', Link_Mus = '{$caminhoMus}', Capa_Mus = '{$caminhoFoto}', Data_Lança_Mus = '{$dtLanc}', Letra_Mus = '{$letra}', Id_Artis_fk = '{$idArt}' WHERE Id_Mus = '{$idMus}';");

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