<?php
require_once './Model/error.model.php';
require_once './view/register.view.php';

class RegisterController{

    private $registerModel;
    private $registerView;
    private $errorModel;
    //Constructor del modelo y la vista
    public function __construct()
    {
        $this->registerModel = new UserModel();
        $this->registerView = new RegisterView();
        $this->errorModel = new ErrorModel();
    }
    //Verifica el usuario que se quiere registrar y luego envía los datos al modelo
    public function newUser(){
        if($_POST['rol'] === 'admin'){
            $rol = 1;
        }else{
            $rol = 2;
        }
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            if($this->registerModel->verifyUser($_POST['user']) == 0){
                $this->registerModel->saveUser([$_POST['user'],password_hash($_POST['password'], PASSWORD_BCRYPT),$rol]);
                header("Location:". BASE_URL . "home");
            }else{
                $this->registerView->showRegister($this->errorModel->errorUserExists());
            }
        }else{
            $this->registerView->showRegister($this->errorModel->errorRegister());
        }
    }
    //Muestra la vista del register
    public function registerView(){
        $this->registerView->showRegister();
    }

    
}