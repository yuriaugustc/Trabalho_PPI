<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $cpf = isset($_GET["cpf"]) ? $_GET["cpf"] : "";

    if($cpf === "")
        exit();

    try {
        $sql = <<<SQL
            SELECT cpf FROM anunciante
                WHERE cpf = '?'
            SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $row = $stmt->fetch();
        
        header('Content-type: application/json');
        echo json_encode($row);

    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>