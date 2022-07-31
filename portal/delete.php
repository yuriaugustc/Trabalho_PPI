<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $idAnuncio = $_GET["id"];
    session_start();
    $email = $_SESSION["email"];
    $sql = <<<sql
        SELECT idAnunciante FROM anunciante
            WHERE email = ?
    sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $idAnunciante = $stmt->fetch();

    $sql = <<<sql
        DELETE FROM anuncio
            WHERE anuncio.idAnuncio = ? AND anuncio.idAnunciante = ?
    sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idAnuncio, $idAnunciante]);
?>