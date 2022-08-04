<?php

    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"];

    $sql = <<<sql
        SELECT idAnunciante FROM anunciante
            WHERE anunciante.email LIKE %?%
    sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $idAnunciante = $stmt->fetch();

    $sql = <<<sql
        SELECT * FROM interesse
            INNER JOIN anuncio ON interesse.idAnuncio = anuncio.idAnuncio
    sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    header('Content-type: application/json');
    echo json_encode($rows);
?>