<?php
    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
    $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["passw"]) ? $_POST["passw"] : "";
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = <<<sql
            INSERT INTO anunciante(nome, cpf, email, senhaHash, telefone)
                VALUES(?,?,?,?,?)
            sql;
            
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute([$nome, $cpf, $email, $senhaHash, $tel]);
        
        header('Content-type: application/json');
        echo json_encode($bool);
    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>