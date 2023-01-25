<?php
declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {
    
    

    function usuarios() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = [];
        $data["nombre"] = $model->mostrarTodo();
        $this->view->showViews(array('templates/header.view.php', 'bdo.view.php', 'templates/footer.view.php'), $data);
    }
    
    function buscarPorUsuarios() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = [];
        $data['roles'] = $model->roles();
        if(isset($_GET['roles']) && !empty($_GET['roles'])){
            $data['usuarios'] = $model->filtrarRol($_GET['roles']);
        }
        
        else if(isset($_GET['usuario']) && !empty($_GET['usuario'])){
            $data['usuarios'] = $model->filtrarUsuario($_GET['usuario']);
        }
        
        
        else if((isset($_GET['mayor']) && !empty ($_GET['mayor'])) || (isset($_GET['menor']) && !empty ($_GET['menor']))){
            empty ($_GET['mayor']) ? $_GET['mayor'] = "999999" : '';
            empty ($_GET['menor']) ? $_GET['menor'] = "0" : '';
            $data['usuarios'] = $model->filtrarSalarioMayorMenor($_GET['menor'],$_GET['mayor']);
        }
        
        
        else if(isset($_GET['retencion']) && !empty ($_GET['retencion'])){
            $data['usuarios'] = $model->filtrarSalarioMayor(($_GET['retencion']));
        }
        else{
            $data['usuarios'] = $model->mostrarTodo();
        }
         $this->view->showViews(array('templates/header.view.php', 'bdo.view.php', 'templates/footer.view.php'), $data);
    }
    
    function buscaDinamica() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $modelRol = new \Com\Daw2\Models\RolModel();
        $data = [];
        $data['roles'] = $modelRol->mostrarTodo();
        if(count($_GET) > 0){
            $data['queryString'] = '&'.http_build_query($_GET);
        }
        if(empty($_GET)){
            $data['usuarios'] = $model->mostrarTodo();
        }else{
            $data['usuarios'] = $model->filtrarDinamico($_GET);
        }
        
         $this->view->showViews(array('templates/header.view.php', 'bdoDinamica.view.php', 'templates/footer.view.php'), $data);
    }


    function usuariosOrdenadosSalario() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = [];
        $data["data"] = $model->nombresOrdenadosSalario();
        $this->view->showViews(array('templates/header.view.php', 'bdo.view.php', 'templates/footer.view.php'), $data);
    }
    function usuarioEstandar() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = [];
        $data["data"] = $model->usuariosEstandar();
        $this->view->showViews(array('templates/header.view.php', 'bdo.view.php', 'templates/footer.view.php'), $data);
    }
    function carlos() {
        $model = new \Com\Daw2\Models\UsuarioModel();
        $data = [];
        $data["data"] = $model->empiezaCarlos();
        $this->view->showViews(array('templates/header.view.php', 'bdo.view.php', 'templates/footer.view.php'), $data);
    }

}
