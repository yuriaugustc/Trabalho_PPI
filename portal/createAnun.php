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
        $cep = $_POST["cep"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $img = $_FILES['srcImg'];
        $srcImg = "./img/imgAnuns/" . $img["name"];
        // movendo a foto para o diretorio;
        move_uploaded_file($img["tmp_name"], $srcImg);
        try{
            $sql = <<<sql
                SELECT idAnunciante FROM anunciante
                    WHERE anunciante.email = ?
            sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            $id = $row["idAnunciante"];
            
            $sql = <<<sql
                INSERT INTO anuncio (titulo, descricao, preco, dataHora, cep, bairro, cidade, estado, idAnunciante, idCategoria)
                VALUES (?,?,?,now(),?,?,?,?,?,?)
            sql;
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $desc, $price, $cep, $bairro, $cidade, $estado, $id, $categoria]);
            
            $sql = <<<sql
                SELECT idAnuncio FROM anuncio
                    WHERE anuncio.titulo = ?
                        AND anuncio.idAnunciante = ?
            sql;

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $id]);
            $row = $stmt->fetch();
            $idAnuncio = $row["idAnuncio"];
            
            $sql = <<<sql
                INSERT INTO foto (nomeArqFoto, idAnuncio)
                    VALUES(?,?)
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
                    INSERT INTO baseEndAjax (cep, cidade, estado)
                       VALUES (?,?,?)
                sql;
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$cep, $cidade, $estado]);
            }
        }catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
    }
?>