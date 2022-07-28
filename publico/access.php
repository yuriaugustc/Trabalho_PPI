<?php
    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $passw = isset($_GET["passw"]) ? $_GET["passw"] : "";

    if($email === "" || $passw === ""){
        header("Location: index.html");
        exit();
    }
    try {
        $sql = <<<sql
            SELECT email, senhaHash FROM anunciante
                WHERE email = "?" AND senhaHash = "?"
            sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $hashpassw]);
        $row = $stmt->fetch();
        $row["senhaHash"] = password_verify($passw, $row["senhaHash"]); //fazendo a comparacao de senha e escrevendo um bool no valor, pois essa comparacao não é possivel no JS, visto que o php quem possui a função de encriptação e verificação;

        header('Content-type: application/json');
        echo json_encode($row);

    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>