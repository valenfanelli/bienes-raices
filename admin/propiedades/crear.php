<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth) {
        header('Location: /');
    }
    require '../../includes/config/database.php';
    $db = conectarDB();
    
    incluirTemplate('header');
    //mensajes de errores
    $errores = [];
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorID = '';
    //consulta para obtener los vendedores
    $consulta = "SELECT * FROM vendedores;";
    $res = mysqli_query($db, $consulta);
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorID = mysqli_real_escape_string($db, $_POST['vendedorID']);
        $creado = date('Y/m/d');
        $imagen = $_FILES['imagen'];
        //Validaciones
        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(strlen($descripcion)<50){
            $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones) {
            $errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$wc) {
            $errores[] = "El numero de baños es obligatorio";
        }
        if(!$estacionamiento) {
            $errores[] = "El numero de lugares para estacionamiento es obligatorio";
        }
        if(!$vendedorID) {
            $errores[] = "Elije un vendedor";
        }
        if(!$imagen['name']  || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }
        //revisar si no hubo errores
        if(empty($errores)) {

            //crear carpeta
            $carpetaimg = '../../imagenes/';
            if(!is_dir($carpetaimg)){
                mkdir($carpetaimg);
            }
            //generar nombre unico
            $nombreimg = md5( uniqid( rand(), true ) ) . ".jpg";
            //subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaimg . $nombreimg );

            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc,
            estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreimg' ,'$descripcion', '$habitaciones', '$wc' ,
            '$estacionamiento', '$creado', '$vendedorID');"; 
            $resultado = mysqli_query($db, $query);
            if($resultado) {
                //Redireccionar
                header('Location: /admin?resultado=1');
            }
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
        <fieldset>
            <legend>Informacion general</legend>
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Informacion de la propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
            <label for="wc">Baños</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorID" id="vendedorID">
                <option value="">--Seleccione--</option>
                <?php while($vendedor = mysqli_fetch_assoc($res)):?>
                    <option <?php echo $vendedorID === $vendedor['id'] ? 'selected' : '';?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php 
    incluirTemplate('footer');
?>