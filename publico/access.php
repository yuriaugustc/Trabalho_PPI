<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $passw = isset($_GET["passw"]) ? $_GET["passw"] : "";

    if($email === "" || $passw === ""){
        header("Location: index.html");
        exit();
    }
    try {
        $hashpassw = password_hash($passw, PASSWORD_BCRYPT);
        $sql = <<<sql
            SELECT email, senhaHash FROM anunciante
                WHERE anunciante.email = ?
            sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $resposta = $stmt->fetch();
        $bool = password_verify($passw, $resposta["senhaHash"]); //fazendo a comparacao de senha e escrevendo um bool no valor, pois essa comparacao não é possivel no JS, visto que o php quem possui a função de encriptação e verificação;
        $row = array(
            "email" => $resposta["email"],
            "passw" => $resposta["senhaHash"],
            "hash" => $hashpassw
        );
        session_start();
        $_SESSION["email"] = $email;
        
        header('Content-type: application/json');
        echo json_encode($row);

    }catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }
?>