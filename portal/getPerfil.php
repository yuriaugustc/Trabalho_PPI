<?php
    require "../anunciante.php";

    function getPerfil(){
        require "../conexaoMysql.php";
        $pdo = mysqlConnect();

        session_start();
        $email = $_SESSION["email"] ?? "";

        if($email == ""){
            header("Location: ../index.html");
            exit();
        }else{
            
            try{
                $sql = <<<sql
                    SELECT * FROM anunciante
                        WHERE anunciante.email = ?
                sql;
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);

                $row = $stmt->fetch();
                $anunciante = new anunciante($row["idAnunciante"], $row["nome"], $row["cpf"], $row["email"], $row["senhaHash"], $row["telefone"]);
                
                header('Content-type: application/json');
                return json_encode($anunciante);
            }catch (Exception $e) {
                exit('Ocorreu uma falha: ' . $e->getMessage());
            }
        }
    }
?>