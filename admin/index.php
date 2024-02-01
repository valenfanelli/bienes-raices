<?php 
    require '../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth) {
        header('Location: /');
    }
    //importar conexion
    require '../includes/config/database.php';
    $db = conectarDB();
    //query
    $query = "SELECT * FROM propiedades;";
    //consultar db
    $resultadocon = mysqli_query($db, $query);
    incluirTemplate('header');
    $resultado = $_GET['resultado'] ?? null; //si no esta lo pone en null
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            //eliminar archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id;";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);
            //eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = $id;";
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('Location: /admin?resultado=3');
            }
        }
    }
?>
<main class="contenedor seccion">
    <h1>Administrador de bienes raices</h1>
    <?php if(intval($resultado) === 1):?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif(intval($resultado) === 2): ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif(intval($resultado) === 3): ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($propiedad = mysqli_fetch_assoc($resultadocon)): ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="" class="imagen-tabla"></td>
                    <td><?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="post" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php 
    mysqli_close($db);
    incluirTemplate('footer');
?>