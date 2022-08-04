<?php 
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $count = $_GET["count"];

    $sql = <<<sql
        SELECT * FROM anuncio
            LIMIT 6 OFFSET ?
    sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$count * 6]);
    $rows = $stmt->fetch();

    header('Content-type: application/json');
    echo json_encode($rows);
?>