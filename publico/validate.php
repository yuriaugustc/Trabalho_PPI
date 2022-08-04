<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $cpf = isset($_GET["cpf"]) ? $_GET["cpf"] : "";

    if($cpf === "")
        exit();
    try {
        $sql = <<<sql
            SELECT anunciante.cpf FROM anunciante
                WHERE anunciante.cpf = ?
            sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cpf]);
        $row = $stmt->fetch();
        
        header('Content-type: application/json');
        echo json_encode($row);

    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>