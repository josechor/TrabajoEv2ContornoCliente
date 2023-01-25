<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Base de datos</h6>                                    
            </div>
            <div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="get" action="/buscaDinamica">

                    <div class="mb-3">
                        <label for="tipo" >Rol:</label>
                        <select name="roles[]" id="rol" multiple class="form-control select2">
                            <option value="">-</option>
                            <?php
                            foreach ($roles as $key => $value) {               
                                ?>                               
                            <option value="<?php echo $value['id_rol']; ?>" <?php echo (!empty($_GET['roles']) && in_array($value['id_rol'], $_GET['roles'])) ? 'selected' : '';?>><?php echo $value['nombre_rol']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" >User:</label>
                        <input type="text" id="usuario" name="usuario" value="<?php echo isset($_GET['usuario']) ? $_GET['usuario'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Mayor o igual:</label>
                        <input type="text" id="menor" name="menor" value="<?php echo isset($_GET['menor']) ? $_GET['menor'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Menor o igual:</label>
                        <input type="text" id="mayor" name="mayor" value="<?php echo isset($_GET['mayor']) ? $_GET['mayor'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Retencion:</label>
                        <input type="text" id="retencion" name="retencion" value="<?php echo isset($_GET['retencion']) ? $_GET['retencion'] : ''?>">
                    </div>
                    <div class="mb-3"><div class="card-body">
                <!--<form action="./?sec=formulario" method="post">                   -->
                <form method="get" action="/buscaDinamica">

                    <div class="mb-3">
                        <label for="tipo" >Rol:</label>
                        <select name="roles[]" id="rol" multiple class="form-control select2">
                            <option value="">-</option>
                            <?php
                            foreach ($roles as $key => $value) {               
                                ?>                               
                            <option value="<?php echo $value['id_rol']; ?>" <?php echo (!empty($_GET['roles']) && in_array($value['id_rol'], $_GET['roles'])) ? 'selected' : '';?>><?php echo $value['nombre_rol']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" >User:</label>
                        <input type="text" id="usuario" name="usuario" value="<?php echo isset($_GET['usuario']) ? $_GET['usuario'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Mayor o igual:</label>
                        <input type="text" id="menor" name="menor" value="<?php echo isset($_GET['menor']) ? $_GET['menor'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Menor o igual:</label>
                        <input type="text" id="mayor" name="mayor" value="<?php echo isset($_GET['mayor']) ? $_GET['mayor'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Retencion:</label>
                        <input type="text" id="retencion" name="retencion" value="<?php echo isset($_GET['retencion']) ? $_GET['retencion'] : ''?>">
                    </div>
                    <div class="mb-3">
                        <a href="." value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" name="enviar" value="Enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
                        <a href="." value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" name="enviar" value="Enviar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
            <div class="mb-3 float-right">  
                <?php
                if (count($usuarios) == 0) {
                    ?>
                    <p>No hay ningun registro con ese username</p>
                    <?php
                } else {
                    ?>
                    <table id="csvTable" class="table table-bordered table-striped  dataTable">
                        <thead>
                            <tr>
                                <th><a href="/buscaDinamica?order=1<?php echo isset($queryString) ? $queryString : ''; ?>">Usuario</a></th>
                                <th><a href="/buscaDinamica?order=2<?php echo isset($queryString) ? $queryString : ''; ?>">Rol</a></th> 
                                <th><a href="/buscaDinamica?order=3<?php echo isset($queryString) ? $queryString : ''; ?>">Salario</a></th>
                                <th><a href="/buscaDinamica?order=4<?php echo isset($queryString) ? $queryString : ''; ?>">Retencion</a></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($usuarios as $columna) {
                                ?>
                                <tr class=" <?php echo!$columna['activo'] ? "table-danger" : "" ?> ">
                                    <td><?php echo $columna['username']; ?></td>
                                    <td><?php echo $columna['nombre_rol']; ?></td>
                                    <td><?php echo $columna['salarioBruto']; ?></td>
                                    <td><?php echo $columna['retencionIRPF']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>


                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div> 
</div>
<!--<script src="./vendor/jquery/jquery.min.js"></script>-->
