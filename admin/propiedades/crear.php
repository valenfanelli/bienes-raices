<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
   
    estaAutenticado();
    
    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();
    incluirTemplate('header');
    //mensajes de errores
    $errores = Propiedad::getErrores();
    
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $propiedad = new Propiedad($_POST['propiedad']);

        //crear carpeta
        $carpetaimg = '../../imagenes/';
        //generar nombre unico
        $nombreimg = md5( uniqid( rand(), true ) ) . ".jpg";
        //Resize imagen
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            //subir imagen
            $propiedad->setImagen($nombreimg);
        }

        $errores = $propiedad->validar();
        //revisar si no hubo errores
        if(empty($errores)) {
            if(!is_dir(CARPETA_IMG)) {
                mkdir(CARPETA_IMG);
            }
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                //guardar imagen en el servidor
                $image->save($carpetaimg . $nombreimg);
            }
            $resultado = $propiedad->guardar();

            //$resultado = mysqli_query($db, $query);
            
        }
        
        
    }
?>
<main class="contenedor seccion">
    <h1>Crear una propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form action="/admin/propiedades/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>