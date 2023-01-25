<div class="card-body">
    <!--<form action="./?sec=formulario" method="post">                   -->
    <form method="post" action="/editar" class="form-group">
        <h1 class="<?php echo isset($error) ? "bg-danger" : ''?>"><?php echo isset($error) ? $error : ''?></h1>
        <div class="row">
            
            <h2>Insertar un producto</h2>
            
            <input type="text" id="cod" name="cod" value="<?php echo $producto[0]['codigo']?>" hidden>
            <div class="mb-3 col-sm-12">
                <label for="tipo" >Codigo: <?php echo $producto[0]['codigo']?></label>
                <input type="text" id="codigo" name="codigo" value="<?php echo $producto[0]['codigo']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo" >Nombre: <?php echo $producto[0]['nombre']?></label>
                <input type="text" id="nombre" name= "nombre" value="<?php echo $producto[0]['nombre']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Descripcion: <?php echo $producto[0]['descripcion']?></label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $producto[0]['descripcion']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Coste: <?php echo $producto[0]['coste']?></label>
                <input type="text" id="coste" name="coste" value="<?php echo $producto[0]['coste']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Margen: <?php echo $producto[0]['margen']?></label>
                <input type="text" id="margen" name="margen" value="<?php echo $producto[0]['margen']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">stock: <?php echo $producto[0]['stock']?></label>
                <input type="text" id="stock" name="stock" value="<?php echo $producto[0]['stock']?>">
            </div>
            <div class="mb-3  col-sm-12">
                <label for="tipo">Id_categoria: <?php echo $producto[0]['id_categoria']?></label>
                <select name="id_categoria" id="id_categoria" class="form-control select1" data-placeholder="Categoria">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($categorias as $c) {
                                        ?>
                                        <option value="<?php echo $c['id_categoria']; ?>" <?php echo $c['id_categoria'] == $producto[0]['id_categoria'] ? 'selected' : ''?>><?php echo ucfirst($c['id_categoria']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
            </div>
            <div class="mb-3 col-sm-12">
                                <label for="rol">Proveedor: <?php echo $producto[0]['proveedor']?></label>
                                <select name="proveedor" id="proveedor" class="form-control select1" data-placeholder="Proveedores">
                                    <option value="">-</option>
                                    <?php
                                    foreach ($proveedores as $p) {
                                        ?>
                                        <option value="<?php echo $p['cif']; ?>" <?php echo $p['cif'] == $producto[0]['proveedor'] ? 'selected' : ''?>><?php echo ucfirst($p['cif']. " ->". $p['nombre']); ?></option>
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
