<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    require "getPerfil.php";
    $anunciante = json_decode(getPerfil());

    $sql = <<<sql
        SELECT * FROM anuncio
            WHERE anuncio.idAnunciante = ?
    sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$anunciante["idAnunciante"]]);

    $rows = $stmt->fetchAll();

    header('Content-type: application/json');
    return json_encode($rows);
?>