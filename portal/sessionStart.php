<?php
    session_start();

    $email = $_GET["email"];

    $_SESSION["email"] = $email;
?>