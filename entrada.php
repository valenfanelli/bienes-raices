<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" loading="lazy" alt="imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el <span>23-01-2024</span> por: <span>Admin</span></p>
        <div class="resumen-propiedad">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis pariatur provident, nesciunt debitis ut incidunt officia? Maxime dolorum reprehenderit enim non odit aliquam perferendis, laborum vero quasi dolores, eius rerum?</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias consequuntur itaque aliquam labore. Quis exercitationem neque beatae illo incidunt dolores iusto ullam repellat pariatur enim autem, voluptatem accusantium vitae blanditiis.</p>
        </div>
    </main>
    <?php 
    incluirTemplate('footer');
?>