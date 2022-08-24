<?php
    require "../anuncio.php";

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
        $stmt->execute(["email"]);
        $row = $stmt->fetch();
        $id = $row["idAnunciante"];
    }catch (Exception $ex) {
        exit('Ocorreu uma falha na conexão com o BD: ' . $ex->getMessage());
    }

    $sql = <<<sql
        SELECT * FROM anuncio a
            WHERE a.idAnunciante = ?
                ORDER BY a.dataHora DESC
    sql;
    
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $arr = array();
        while($row = $stmt->fetch()){
            $anuncio = new anuncio($row["idAnuncio"], $row["titulo"], $row["descricao"], $row["preco"], $row["dataHora"], $row["cep"], $row["bairro"], $row["cidade"], $row["estado"], $row["idAnunciante"], $row["idCategoria"]);
            array_push($arr, $anuncio);
        }
        header('Content-type: application/json');
        echo json_encode($arr);
    }catch (Exception $ex) {
        exit('Ocorreu uma falha na conexão com o BD: ' . $ex->getMessage());
    }

?>