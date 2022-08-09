<?php
    require "../interessado.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"];

    $sql = <<<sql
        SELECT idAnunciante FROM anunciante
            WHERE anunciante.email = ?
    sql;
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        $id = $row["idAnunciante"];

        $sql = <<<sql
            SELECT * FROM interesse
                INNER JOIN anuncio 
                ON interesse.idAnuncio = anuncio.idAnuncio
                AND anuncio.idAnunciante = ?
        sql;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $arr = [];
        while($row = $stmt->fetch()){
            $interessado = new interessado($row["idInteresse"], $row["mensagem"], $row["dataHora"], $row["contato"], $row["idAnuncio"]);
            array_push($arr, $interessado);
        }
        header('Content-type: application/json');
        echo json_encode($arr);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>