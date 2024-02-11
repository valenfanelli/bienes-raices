<fieldset>
            <legend>Informacion general</legend>
            <label for="titulo">Titulo</label>
            <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo propiedad" value="<?php

use App\Vendedor;

 echo s($propiedad->titulo); ?>">
            <label for="precio">Precio</label>
            <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio); ?>">
            <label for="imagen">Imagen</label>
            <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png">
            <?php if($propiedad->imagen) { ?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="">
            <?php } ?>
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Informacion de la propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">
            <label for="wc">Baños</label>
            <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ej: 3" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="propiedad[vendedores_id]" id="vendedor">
                <option 
                 value="">--Seleccione--</option>
                <?php foreach($vendedores as $vendedor){?>
                    <option <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
                    value="<?php echo s($vendedor->id); ?>" ><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
                <?php } ?>
            </select>

        </fieldset>