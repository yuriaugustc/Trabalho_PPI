<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"];

    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $categoria = $_POST["categoria"];
        $price = $_POST["price"];
        $date = $_POST["date"];
        $cep = $_POST["cep"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $srcImg = $_POST["srcImg"];

        $sql = <<<sql
            SELECT idAnunciante FROM anunciante
                WHERE anunciante.cpf = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $id = $stmt->fetch();
        $sql = <<<sql
            INSERT INTO anuncio VALUES
                (?,?,?,now(),?,?,?,?,?)
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $desc, $price, $cep, $bairro, $cidade, $estado, $id, $categoria]);

        $sql = <<<sql
            SELECT idAnuncio FROM anuncio
                WHERE anuncio.titulo = ?
                    AND anuncio.idAnunciante = ?
                    AND anuncio.dataHora = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $id, $date]);
        $idAnuncio = $stmt->fetch();
        $sql = <<<sql
            INSERT INTO foto VALUES
                (?,?)
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$srcImg, $idAnuncio]);
        //depois de realizar o INSERT, o php fará uma verificação se o endereço existe na baseEndAJAX

        $sql = <<<sql
            SELECT * FROM baseEndAjax
                WHERE baseEndAjax.cep = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep]);
        $bool = $stmt->fetch();
        if(!$bool){
            $sql = <<<sql
                INSERT INTO baseEndAjax VALUES
                    (?,?,?)
            sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cep, $cidade, $estado]);
        }
    }
?>