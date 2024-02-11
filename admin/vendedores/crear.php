<?php
require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();
incluirTemplate('header');
$vendedor = new Vendedor;
$errores = Vendedor::getErrores();
    
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Instanciar
        $vendedor = new Vendedor($_POST['vendedor']);
        //Validar que no haya campos vacios
        $errores = $vendedor->validar();
        if(empty($errores)) {
            $vendedor->guardar();
        }
    }

?>
<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form action="/admin/vendedores/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
</main>

<?php 
    incluirTemplate('footer');
?>