<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "banco_projeto";
    $port = 3307;

    $mysqli = new mysqli($host, $user, $pass, $bd, $port);

    if ($mysqli -> connect_errno) {
        echo "Connect failed: " . $mysqli -> connect_errno;
        exit();
    }
?>