<?php
    require "../anuncio.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $cont = $_GET["count"];

    $txtSearch = $_POST["txtSearch"];
    $where = $_POST["where"];
    $min = $_POST["min"];
    $max = $_POST["max"];
    $cat = $_POST["categoria"];
    $sql = "";

    if($where == 1)
        $sql = <<<sql
            SELECT * FROM anuncio a
                WHERE a.titulo LIKE '%?%' AND
                    a.idCategoria = ? AND
                    a.preco BETWEEN ? AND ?
                    ORDER BY a.dataHora DESC
                    LIMIT 6 OFFSET ?
        sql;
    else
        $sql = <<<sql
            SELECT * FROM anuncio a
                WHERE a.descricao LIKE '%?%' AND
                    a.idCategoria = ? AND
                    a.preco BETWEEN ? AND ?
                    ORDER BY a.dataHora DESC
                    LIMIT 6 OFFSET ?
        sql;

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$txtSearch, $cat, $min, $max, ($cont * 6)]);
        $arr = [];
        while($row = $stmt->fetch()){
            $anuncio = new anuncio($row["idAnuncio"], $row["titulo"], $row["descricao"], $row["preco"], $row["dataHora"], $row["cep"], $row["bairro"], $row["cidade"], $row["estado"], $row["idAnunciante"], $row["idCategoria"]);
            array_push($arr, $anuncio);
        }

        header("Content-type: application/json");
        echo json_encode($arr);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>