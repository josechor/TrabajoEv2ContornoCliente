<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class ProveedorController extends \Com\Daw2\Core\BaseController {

    function proveedores() {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $data = [];
        
        //Controlamos si se ha pasado algun dato por get.
        //Si esto es asi, comprobamos cual y vamos y llamamos a la funcion correspondiente
        if (count($_GET) != 0) {
            if (isset($_GET['añadir'])) {
                $data["update"] = $model->insert($_GET);
            } else if (isset($_GET['borrado'])) {
                $data['borrado'] = $model->borrar($_GET);
            } else if (isset($_GET['editar'])) {
                $data['cambios'] = $model->cambios($_GET);
            }
        }



        //Obtenemos todos los proveedores y los mostramos
        $data["data"] = $model->allProveedor();
        $this->view->showViews(array('templates/header.view.php', 'bdoProveedores.view.php', 'templates/footer.view.php'), $data);
    }

    //Funcion para editar los datos.
    //Obtiene todos los datos de un usuario por su cif y los muestra
    function editar() {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $data = [];
        $data['usuarioEditado'] = $_GET['editar'];
        $data['datos'] = $model->datos($_GET);

        $this->view->showViews(array('templates/header.view.php', 'editarProveedor.view.php', 'templates/footer.view.php'), $data);
    }
    
    //Esta funcion solo llama a la vista de insertar
    function insertar(){
        $this->view->showViews(array('templates/header.view.php', 'insertarProveedor.view.php', 'templates/footer.view.php'));
    }

}
