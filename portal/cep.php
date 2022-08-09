<?php
    require "../cep.php";
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();
    session_start();
    $email = $_SESSION["email"];

    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{

        $cep = $_GET["cep"];
        try{
            $sql = <<<sql
                SELECT * FROM baseEndAjax
                    WHERE baseEndAjax.cep = ?
            sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cep]);

            $row = $stmt->fetch();
            $endereco = new cep($row["cep"], $row["cidade"], $row["estado"]);
            
            header('Content-type: application/json');
            echo json_encode($endereco);
        }catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
    }
?>