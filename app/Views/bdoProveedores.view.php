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
                class="card-header py-3 d-flex flex-row align-items-center justify-content-lg-around col-12 text-center">
                 <h2 class="m-0 font-weight-bold text-primary"><a href="/insertarProveedor" class="btn btn-primary">Insertar usuario</a></h2>  
                 <h2 class=" font-weight-bold text-right text-secondary"><a href="/bdoProveedores" class="btn btn-info">Reiniciar pagina</a></h2>
            </div>
            

            <div class="card-body text-center">
                <?php
                if (isset($update)) {
                ?>
                <h2 class="<?php echo !$update['error'] ? 'bg-success' : 'bg-warning' ?>"><?php echo $update['mensaje'] ?></h2>
                <?php
                }
                ?>
                <?php
                if (isset($cambios)) {
                ?>
                <h2 class="<?php echo !$cambios['error'] ? 'bg-success' : 'bg-warning' ?>"><?php echo $cambios['mensaje'] ?></h2>
                <?php
                }
                ?>

                <?php
                if (isset($borrado)) {
                ?>
                <h2 class="<?php echo !$borrado['error'] ? 'bg-success' : 'bg-warning' ?>"><?php echo $borrado['mensaje'] ?></h2>
                <?php
                }
                ?>

            </div>


            <div class="card-body">  
                <table id="csvTable" class="table table-bordered table-striped  dataTable">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Pagina Web</th>
                            <th>Email</th>                                                        
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        foreach ($data as $columna) {
                            ?>
                            <tr class=" <?php echo (isset($columna['pais']) && $columna['pais'] != "España") ? "table-secondary" : '' ?>">
                                <td><?php echo $columna['codigo']; ?></td>
                                <td><?php echo $columna['nombre']; ?></td>
                                <td><?php echo $columna['website']; ?></td>
                                <td><?php echo $columna['email']; ?></td>
                                <td><a href="/bdoProveedores?borrado=<?php echo $columna['cif']; ?>" class="btn btn-danger ml-1"><i class="fas fa-trash"></i></a> | <a href="/editarProveedor?editar=<?php echo $columna['cif']; ?>" class="btn btn-success ml-1"><i class="fas fa-edit"></i></a></td>
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
