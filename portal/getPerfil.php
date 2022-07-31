<?php

    function getPerfil(){
        require "../conexaoMysql.php";
        $pdo = mysqlConnect();

        session_start();
        $email = $_SESSION["email"];

        $sql = <<<sql
            SELECT * FROM anunciante
                WHERE anunciante.email = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $row = $stmt->fetch();

        header('Content-type: application/json');
        return json_encode($row);
    }
?>