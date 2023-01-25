<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">Base de datos</h3>                                    
            </div>
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-lg-start col-12">
                <h2 class="m-0 font-weight-bold text-primary"><a href="/insertarProducto" class="btn btn-primary">Insertar producto</a></h2>  
            </div>
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="get" action="/bdoProductos">


                    <div class="mb-3">
                        <label for="tipo" >Codigo:</label>
                        <input type="text" id="codigo" name="codigo" value="<?php echo isset($_GET['codigo']) ? $_GET['codigo'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Proveedor:</label>
                        <select name="proveedores[]" id="proveedores" multiple class="form-control select2">
                            <?php
                            foreach ($proveedores as $key => $value) {
                                ?>                               
                                <option value="<?php echo $value['cif']; ?>" <?php echo (!empty($_GET['proveedores']) && in_array($value['cif'], $_GET['proveedores'])) ? 'selected' : ''; ?>><?php echo $value['cif'] . " -> " . $value['nombre']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Categoria:</label>
                        <select name="categorias[]" id="categorias" multiple class="form-control select2">
                            <?php
                            foreach ($categorias as $key => $value) {
                                ?>                               
                                <option value="<?php echo $value['id_categoria']; ?>" <?php echo (!empty($_GET['categorias']) && in_array($value['id_categoria'], $_GET['categorias'])) ? 'selected' : ''; ?>><?php echo $value['id_categoria'] . ' -> ' . $value['nombre_categoria']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <a href="/bdoProductos" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                    <input type="submit" name="Buscar" value="Buscar" class="btn btn-primary"/>
                </form>
            </div>
            <div class="mb-3">


                <div class="card-body">  
                    <table id="csvTable" class="table table-bordered table-striped  dataTable">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Proveedor</th>                                                        
                                <th>Precio venta</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($productos as $columna) {
                                ?>
                                <tr>
                                    <td><?php echo $columna['codigo']; ?></td>
                                    <td><?php echo $columna['nombre']; ?></td>
                                    <td><?php echo $columna['id_categoria']; ?></td>
                                    <td><?php echo $columna['proveedor']; ?></td>
                                    <td><?php echo $columna['coste']; ?></td>
                                    <td><a href="/deleteProducto?codigo=<?php echo $columna['codigo'] ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a> | <a href="/editar?codigo=<?php echo $columna['codigo'] ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <?php
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <!--<script src="./vendor/jquery/jquery.min.js"></script>-->
