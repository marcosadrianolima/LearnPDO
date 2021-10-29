<?php
    require './Conn.php';
    $conexao = Conn::getConexao();

    $query = $conexao->query("SELECT * from usuarios");
    $query->execute();

    $usuarios = $query->fetch();
    echo"<pre>";
    var_dump($usuarios);
    