<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMG', __DIR__ . '/../imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}
function estaAutenticado(): bool {
    session_start();
    if(!$_SESSION['login']) {
        header('Location: /');
    }
    return false;
}
function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
//escapar el HTML
function s ($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function validarTipoContenido ($tipo) {
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}
function mostrarNotificacion($codigo) {
    $mensaje = '';
    switch($codigo){
        case 1: $mensaje = 'Creado correctamente';
                break;
        case 2: $mensaje = 'Actualizado correctamente';
                break;
        case 3: $mensaje = 'Eliminado correctamente';
                break;
        default:    $mensaje = false;
                break;
    }
    return $mensaje;
}