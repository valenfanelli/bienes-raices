<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
use App\Vendedor;
    require '../../includes/app.php';
    estaAutenticado();
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header('Location: /admin');
    }
    
    $propiedad = Propiedad::find($id);
    incluirTemplate('header');
    //mensajes de errores
    $errores = Propiedad::getErrores();
    
    //consulta para obtener los vendedores
    $vendedores = Vendedor::all();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $args = [];
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
        $errores = $propiedad->validar();
        $nombreimg = md5( uniqid( rand(), true ) ) . ".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            //subir imagen
            $propiedad->setImagen($nombreimg);
        }
        //revisar si no hubo errores
        if(empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMG . $nombreimg);
            }
            $propiedad->guardar();
        }
        
        
    }
?>
<main class="contenedor seccion">
    <h1>Actualizar una propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>