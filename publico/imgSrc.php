<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $idAnuncio = $_GET["id"];

    $sql = <<<sql
        SELECT nomeArqFoto FROM foto
            WHERE foto.idAnuncio = ?
    sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idAnuncio]);

    $nome = $stmt->fetch();

    header("Content-type: application/json");
    echo json_encode($nome);
?>