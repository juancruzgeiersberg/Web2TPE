<?php 
require_once './Controller/proyect.controller.php';
require_once './Controller/login.controller.php';
require_once './Controller/register.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

//Reconoce el action que envía el usuario
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    // Acción por defecto si el usuario no envió nada
    $action = 'home';
}

$params = explode('/', $action);
//Ejecuta el action dependiendo su valor
switch ($params[0]){
    case 'home':
        $proyectController = new ProyectController();
        $proyectController->showHome();
        break;
    case 'login':
        $loginController = new LoginController();
        $loginController->loginView();
        break;
    case 'register':
        $registerController = new RegisterController();
        $registerController->registerView();
        break;
    case 'access':
        $loginController = new LoginController();
        $loginController->authUser();
        break;
    case 'registerUser':
        $registerController = new RegisterController();
        $registerController->newUser();
        break;
    case 'disconect':
        $loginController = new LoginController();
        $loginController->disconect();
        break;
    case 'series':
        $proyectController = new ProyectController();
        $proyectController->showAllProyects();
        break;
    case 'new_serie':
        $proyectController = new ProyectController();
        $proyectController->newSerie();
        break;
    case 'add_serie':
        $proyectController = new ProyectController();
        $proyectController->insertProyect();
        break;
    case 'seasons':
        if(!empty($_POST['table']) && !empty($_POST['serie_id'])){
            $proyectController = new ProyectController();
            $proyectController->showAllSeasons($_POST['table'],$_POST['serie_id']);
            break; 
        }else{
            header("Location:" . BASE_URL . "home");
        }
        
    default:
        
        break;
}