<?php
    require "../foto.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $idAnuncio = $_GET["id"];
    try{
        $sql = <<<sql
            SELECT nomeArqFoto FROM foto
                WHERE foto.idAnuncio = ?
        sql;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idAnuncio]);

        $row = $stmt->fetch();
        $nome = new foto($row["nomeArqFoto"]);
            
        header("Content-type: application/json");
        echo json_encode($nome);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>