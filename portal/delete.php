<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();
    session_start();
    $email = $_SESSION["email"] ?? "";
    if($email === ""){
        header("Location: ../index.html");
        exit();
    }
    try{
        $idAnuncio = $_GET["id"];
        
        $sql = <<<sql
            SELECT idAnunciante FROM anunciante
                WHERE email = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        $idAnunciante = $row["idAnunciante"];

        $sql = <<<sql
            DELETE FROM anuncio
                WHERE anuncio.idAnuncio = ? AND anuncio.idAnunciante = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idAnuncio, $idAnunciante]);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>