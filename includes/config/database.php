<?php
function conectarDB() : mysqli {
    $db = new mysqli('localhost' ,'root', 'root', 'bienesraices_crud');
    if(!$db){
        echo "ocurrio un error al conectar";
        exit;
    }
    return $db;
}