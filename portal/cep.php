<?php
    session_start();
    $email = $_SESSION["email"];
    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{
        require "../conexaoMysql.php";
        $pdo = mysqlConnect();

        $cep = $_GET["cep"];

        $sql = <<<sql
            SELECT * FROM baseEndAjax
                WHERE baseEndAjax.cep = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep]);

        $row = $stmt->fetch();
        header('Content-type: application/json');
        echo json_encode($row);
    }
?>