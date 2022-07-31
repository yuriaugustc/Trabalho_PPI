<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"];

    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $passw = password_hash($_POST["passw"], PASSWORD_BCRYPT);

        $sql = <<<sql
            SELECT idAnunciante FROM anunciante
                WHERE anuncio.cpf = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $id = $stmt->fetch();
        $sql = <<<sql
            UPDATE anunciante
                SET anunciante.nome = ?,
                    anunciante.cpf = ?,
                    anunciante.tel = ?,
                    anunciante.email = ?
                    anunciante.senhaHash = ?
            WHERE anunciante.id = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cpf, $tel, $email, $passw, $id]);
    }

?>

//recebe dados por POST