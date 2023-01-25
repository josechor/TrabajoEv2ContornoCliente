<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class ProductosController extends \Com\Daw2\Core\BaseController {

    function proveedores() {
        $model = new \Com\Daw2\Models\ProductosModel();
        $data = [];
        if (isset($_GET['Buscar'])) {
            $data['productos'] = $model->buscaDinamica($_GET);
        } else {
            $data['productos'] = $model->allProductos();
        }

        $model2 = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $model2->categorias();

        $model3 = new \Com\Daw2\Models\ProveedoresModel();
        $data['proveedores'] = $model3->allProveedor();

        $this->view->showViews(array('templates/header.view.php', 'bdoProductos.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarInsertar() {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $data['proveedores'] = $model->proveedores();
        $model = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $model->categorias();

        $this->view->showViews(array('templates/header.view.php', 'insertarProducto.view.php', 'templates/footer.view.php'), $data);
    }

    function insertarProducto() {
        $model = new \Com\Daw2\Models\ProductosModel();
        $data = [];
        $errores = $model->insertar($_POST);
        header('Location: /bdoProductos');
    }

    function delete() {
        $model = new \Com\Daw2\Models\ProductosModel();
        $error = $model->borrar($_GET);
        $error ? header('Location: /error') : header('Location: /bdoProductos');
    }

    function mostrarEditar() {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        (isset($_GET['mensaje']) && !empty($_GET['mensaje'])) ? $data['error'] = $_GET['mensaje'] : '';
        $data['proveedores'] = $model->proveedores();
        $model = new \Com\Daw2\Models\CategoriaModel();
        $data['categorias'] = $model->categorias();
        $model = new \Com\Daw2\Models\ProductosModel();
        $data['producto'] = $model->obtenerDatos($_GET['codigo']);
        $this->view->showViews(array('templates/header.view.php', 'editarProducto.view.php', 'templates/footer.view.php'), $data);
    }

    function editar() {
        $model = new \Com\Daw2\Models\ProductosModel();
        $error = $model->editar($_POST);
        if ($error['error']) {
            header("Location: /editar?codigo={$_POST['cod']}&mensaje={$error['mensaje']}");
        } else {
            header('Location: /bdoProductos');
        }
    }

}
