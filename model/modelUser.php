<?php /*User*/  
    include_once('model.php');
    
    function listarTudoUser()
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $query = "select Id_Usua as 'Código', Nome_Usua as 'Nome de Usuário', Email_Usua as 'E-mail' from tb_usuario";
      $resultado = mysqli_query($conexao, $query);
      
      return $resultado;
    }

    function listarUserCodigo()
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $cod = $_POST["txt_UserCod"];

      $query = "select Id_Usua as 'Código', Nome_Usua as 'Nome de Usuário', Email_Usua as 'E-mail' from tb_usuario where Id_Usua = '{$cod}'";
      $resultado = mysqli_query($conexao, $query);

      return $resultado;
    }
    
    function listarUserEmail()
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $email = $_POST["txt_UserEmail"];

      $query = "select Id_Usua as 'Código', Nome_Usua as 'Nome de Usuário', Email_Usua as 'E-mail' from tb_usuario where Email_Usua like '%{$email}%'";
      $resultado = mysqli_query($conexao, $query);

      return $resultado;
    }

    function deletarUser()
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
        $teste = $conexao -> query("DELETE FROM tb_artista WHERE Id_Artis = ".$art["Código"]); //Deletar artista
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
    
    function alterarUser()
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $nome = $_POST["txt_NovoNome"]; 
      $email = $_POST["txt_NovoEmail"];
      $senha = $_POST["txt_NovaSenha"];
      $cod = $_POST["codAlterar"];

      $opcao = ['cos' => 8];
      $senhaC = password_hash($senha, PASSWORD_BCRYPT, $opcao);

      $query = "update tb_usuario set Nome_Usua = '{$nome}', Email_Usua = '{$email}', Senha_Usua = '{$senhaC}' where Id_Usua = '{$cod}'";

      $resultado = mysqli_query($conexao, $query);

      return $resultado;
    }
    
?>
