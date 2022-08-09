<?php

    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $msgInteresse = $_GET["msg"];
    $tel = $_GET["tel"];
    $title = $_GET["title"];
    try{
        $sql =  <<<sql
            SELECT idAnuncio FROM anuncio
                WHERE anuncio.titulo LIKE %?%
        sql;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title]);
        $idAnuncio = $stmt->fetch();

        $sql = <<<sql
            INSERT INTO interesse (idInteresse, mensagem, dataHora, contato, idAnuncio)
                VALUES (?, now(), ?, ?)
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$msgInteresse, $tel, $idAnuncio]);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>