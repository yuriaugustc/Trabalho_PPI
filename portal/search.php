<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $string = isset($_GET["search"]) ? $_GET["search"] : "";
    if($string === ""){
        header("Location: index.html");
        exit();
    }
    try {
        $search = explode(" ", $string);
        $sql = <<<sql
            SELECT titulo FROM anuncio
                WHERE anuncio LIKE %?%
                    AND %?%
                        AND %?%
                            AND %?%
                                AND %?%
                                    ORDER anuncio.dataHora BY DESC
            sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search[0],$search[1],$search[2],$search[3],$search[4]]);

        $rows = $stmt->fetchAll();
        header('Content-type: application/json');
        echo json_encode($rows);

    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>