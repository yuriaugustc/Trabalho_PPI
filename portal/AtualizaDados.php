<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"] ?? "";

    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{
        $nome = $_POST["nome"] ?? "";
        $cpf = $_POST["cpf"] ?? "";
        $tel = $_POST["tel"] ?? "";
        $email1 = $_POST["email"] ?? "";
        $passw = password_hash($_POST["passw"], PASSWORD_BCRYPT);

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
                UPDATE anunciante
                    SET anunciante.nome = ?,
                    anunciante.cpf = ?,
                    anunciante.telefone = ?,
                    anunciante.email = ?,
                    anunciante.senhaHash = ?
                WHERE anunciante.idAnunciante = ?
            sql;

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cpf, $tel, $email1, $passw, $id]);
        }catch (Exception $ex) {
            exit('Ocorreu uma falha na conexão com o BD: ' . $ex->getMessage());
        }
    }

?>