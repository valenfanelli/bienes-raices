<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" loading="lazy" alt="sobre nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni illum nesciunt commodi iusto explicabo distinctio a delectus reiciendis impedit, quos sequi porro accusantium veniam laborum ratione sint earum eius eaque.
                </p>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni illum nesciunt commodi iusto explicabo distinctio a delectus reiciendis impedit, quos sequi porro accusantium veniam laborum ratione sint earum eius eaque.
                </p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ipsam labore voluptatibus debitis molestiae magni, id perferendis exercitationem recusandae, voluptates dicta officia commodi saepe distinctio ex sint totam iste illo?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ipsam labore voluptatibus debitis molestiae magni, id perferendis exercitationem recusandae, voluptates dicta officia commodi saepe distinctio ex sint totam iste illo?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati ipsam labore voluptatibus debitis molestiae magni, id perferendis exercitationem recusandae, voluptates dicta officia commodi saepe distinctio ex sint totam iste illo?</p>
            </div>
        </div>
    </section>
    <?php 
   incluirTemplate('footer'); 
?>