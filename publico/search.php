<?php
    require "../anuncio.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();
    $string = isset($_GET["search"]) ? $_GET["search"] : "";
    $number = isset($_GET["number"]) ? $_GET["number"] : "";
    if($string === ""){
        header("Location: index.html");
        exit();
    }
    try {
        $search = explode(" ", $string);
        $sql = <<<sql
            SELECT * FROM anuncio
                WHERE anuncio.descricao LIKE '%?%'
                    AND anuncio.descricao LIKE '%?%'
                    AND anuncio.descricao LIKE '%?%'
                    AND anuncio.descricao LIKE '%?%'
                    AND anuncio.descricao LIKE '%?%'
                        ORDER BY anuncio.dataHora DESC
                            LIMIT 6 OFFSET ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search[0] ?? "",$search[1] ?? "",$search[2] ?? "",$search[3] ?? "",$search[4]] ?? "", ($number * 6));
        
        $arr = array();
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