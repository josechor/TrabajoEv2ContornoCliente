<form method="get" action="/bdoProveedores?cambios=true">
    <div class="row">

        <h2 class="<?php echo isset($usuarioEditado)? "bg-success" : "bg-danger" ?>">Editando el proveedor con cif: <?php echo isset($usuarioEditado) ? $usuarioEditado : 'No hay nadie seleccionado'?></h2>
        <div class="mb-3 col-sm-6"></div>
        <div class="">
            <input type="text" id="cifAntiguo" name="cifAntiguo" value="<?php echo isset($usuarioEditado) ? $usuarioEditado :''?>" hidden>
        </div>
        <div class="mb-3 col-sm-6">
            <label for="tipo" >Cif:</label>
            <input type="text" id="cif" name="cif" value="<?php echo isset($datos[0]['cif']) ? $datos[0]['cif'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo" >Codigo:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo isset($datos[0]['codigo']) ? $datos[0]['codigo'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($datos[0]['nombre']) ? $datos[0]['nombre'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo">Direccion:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo isset($datos[0]['direccion']) ? $datos[0]['direccion'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo">Pagina web:</label>
            <input type="text" id="website" name="website" value="<?php echo isset($datos[0]['website']) ? $datos[0]['website'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo">Pais:</label>
            <input type="text" id="pais" name="pais" value="<?php echo isset($datos[0]['pais']) ? $datos[0]['pais'] : '' ?>">
        </div>
        <div class="mb-3  col-sm-6">
            <label for="tipo">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($datos[0]['email']) ? $datos[0]['email'] : '' ?>">
        </div>
        <div>
        </div>
        <div class="mb-3">
            <input type="submit" name="editar" value="Aplicar cambios" class="btn btn-primary"/>
            <a href="/bdoProveedores" class="btn btn-info">Volver a proveedores</a>
        </div>
    </div>
</form>
