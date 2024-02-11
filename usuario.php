<?php
    require 'includes/app.php';
    $db = conectarDB();
    $email = "correo@correo.com";
    $password = '123456';
    $passhash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passhash');";
    mysqli_query($db, $query);
?>