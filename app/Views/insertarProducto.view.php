<div class="card-body">
    <!--<form action="./?sec=formulario" method="post">                   -->
    <form method="post" action="/insertarProducto" class="form-group">
        <div class="row">
            <h2>Insertar un producto</h2>
            <div class="mb-3 col-sm-12"></div>
            <div class="mb-3 col-sm-12">
                <label for="tipo" >Codigo:</label>
                <input type="text" id="codigo" name="codigo" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo" >Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Descripcion:</label>
                <input type="text" id="descripcion" name="descripcion" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Coste:</label>
                <input type="text" id="coste" name="coste" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Margen:</label>
                <input type="text" id="margen" name="margen" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">stock:</label>
                <input type="text" id="stock" name="stock" value="">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Id_categoria:</label>
                <select name="id_categoria" id="id_categoria" class="form-control select1" data-placeholder="Categoria">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($categorias as $c) {
                                        ?>
                                        <option value="<?php echo $c['id_categoria']; ?>"><?php echo ucfirst($c['id_categoria']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
            </div>
            <div class="mb-3 col-sm-12">
                                <label for="rol">Proveedor:</label>
                                <select name="proveedor" id="proveedor" class="form-control select1" data-placeholder="Proveedores">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($proveedores as $p) {
                                        ?>
                                        <option value="<?php echo $p['cif']; ?>"><?php echo ucfirst($p['cif']. " ->". $p['nombre']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
            <div class="mb-3  col-sm-12">
            <div class="mb-3  col-sm-12">
                <label for="tipo">Iva:</label>
                <input type="text" id="iva" name="iva" value="21" readonly>
            </div>
            
            <div class="mb-3">
                <a href="." value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                <input type="submit" name="añadir" value="Añadir" class="btn btn-primary"/>
                <a href="/bdoProductos" class="btn btn-info">Volver a productos</a>
            </div>
        </div>
    </form>
</div>
