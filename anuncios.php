<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Anuncios</h1>
        <section class="contenedor">
            <h2>Casas y depas en venta</h2>
            <?php 
                $limite = 10;
                include 'includes/templates/anuncios.php';
            ?>
        </section>
    </main>
<?php 
    incluirTemplate('footer');
?>