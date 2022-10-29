<?php

  function inserirPessoaBanco()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $nomeUser = $_POST["txt_NomeUser"];
      $email = $_POST["txt_Email"];
      $senha = $_POST["txt_Senha"];
      $opcao = ['cos' => 8];
      $senhaC = password_hash($senha, PASSWORD_BCRYPT, $opcao);

      $nomeCli = $_POST["txt_Nome"];
      $dtNasc = $_POST["dt_DtNasc"];
      $fone = $_POST["txt_Tel"];
      $artista = "N";
      
      $conexao -> autocommit(false);
      
      $conexao -> query("insert into tb_usuario(Nome_Usua, Email_Usua, Senha_Usua) values('{$nomeUser}', '{$email}', '{$senhaC}');");
      
      $userId = $conexao -> insert_id;
      
      $conexao -> query("insert into tb_cliente(Nome_Clie, Dt_Nasc, Fone_Clie, Artista, Id_Usua_fk) values('{$nomeCli}', '{$dtNasc}', '{$fone}', '{$artista}', '{$userId}');");
      
      $resultado = $conexao -> commit();

      return $resultado;
    }
    catch (mysqli_sql_exception $exception) 
    {
      throw $exception;
    }
  }
?>