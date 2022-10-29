<?php
    function zerarUserIncrement()
    {
        $c = new Conexao();
        $conexao = $c -> conectar();

        $qntLinhas = $conexao -> query("select * from tb_usuario");

        if ($qntLinhas -> num_rows == 0)
        {
        $conexao -> autocommit(false);
        $conexao -> query("alter table tb_usuario auto_increment = 0");
        $conexao -> query("alter table tb_cliente auto_increment = 0");
        $conexao -> commit();
        }
    }

    function zerarMusIncrement()
    {
      $c = new Conexao();
      $conexao = $c -> conectar();

      $qntLinhas = $conexao -> query("select * from tb_musica");

      if ($qntLinhas -> num_rows == 0)
      {
        $conexao -> query("alter table tb_musica auto_increment = 0");
      }
    }

    function converteData($data)
    {
      if (strstr($data, "/"))
      {
        $d = explode ("/", $data);
        $rstData = "$d[2]-$d[1]-$d[0]";
        return $rstData;
      }
      else if(strstr($data, "-"))
      {
        $data = substr($data, 0, 10);
        $d = explode ("-", $data);
        $rstData = "$d[2]/$d[1]/$d[0]";
        return $rstData;
      }
      else{
          return '';
      }
    }
?>