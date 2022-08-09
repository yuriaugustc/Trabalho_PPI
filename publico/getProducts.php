<?php 
    require "../anuncio.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $count = $_GET["count"];
    try{
        $sql = <<<sql
            SELECT * FROM anuncio
                ORDER BY anuncio.dataHora DESC
                LIMIT 6 OFFSET ?
        sql;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([($count * 6)]);
        $arr = [];
        while($row = $stmt->fetch()){
            $anuncio = new anuncio($row["idAnuncio"], $row["titulo"], $row["descricao"], $row["preco"], $row["dataHora"], $row["cep"], $row["bairro"], $row["cidade"], $row["estado"], $row["idAnunciante"], $row["idCategoria"]);
            array_push($arr, $anuncio);
        }

        header('Content-type: application/json');
        echo json_encode($arr);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>