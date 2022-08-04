<?php

    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $msgInteresse = $_GET["msg"];
    $tel = $_GET["tel"];
    $title = $_GET["title"];

    $sql =  <<<sql
        SELECT anuncio.idAnuncio FROM anuncio
            WHERE anuncio.titulo LIKE %?%
    sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title]);
    $idAnuncio = $stmt->fetch();

    $sql = <<<sql
        INSERT INTO interesse
            VALUES (?, now(), ?, ?)
    sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$msgInteresse, $tel, $idAnuncio]);
?>