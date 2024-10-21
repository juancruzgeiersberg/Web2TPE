<?php

require_once './Model/serie.model.php';
require_once './Model/user.model.php';
require_once './view/proyectView.php';
require_once './helpers/auth.php';

class ProyectController{

    private $proyectModel;
    private $errorModel;
    private $userModel;
    private $proyectView;
    //Constructor del Modelo y la Vista
    public function __construct()
    {
        $this->proyectModel = new ProyectModel();
        $this->userModel = new UserModel();
        $this->errorModel = new ErrorModel();
        $this->proyectView = new ProyectsView();
    }
    //Muestra el Home
    public function showHome(){
        $this->proyectView->home();
    }
    //Muestra todas las series
    public function showAllProyects($aux=""){
        if(!empty($aux)){
            $this->proyectView->getAllProyectsView($this->proyectModel->getProyects($aux));
        }else{
            $this->proyectView->getAllProyectsView($this->proyectModel->getProyects());
        }

    }
    //Muestra todas las temporadas de una serie
    public function showAllSeasons($table,$aux){
        $this->proyectView->getAllSeasonsView($this->proyectModel->getProyects($table,$aux));
    }
    //Muestra la vista para crear un proyecto
    public function newSerie(){
        AuthHelper::verify();
        $this->proyectView->new_serie();
    }
    //Inserta un proyecto nuevo y lo vincula con el usuario
    public function insertProyect(){
        if(!empty($_POST['name_serie'])){
            AuthHelper::init();
            $this->proyectModel->addProyect([$_POST['name_serie'],$_POST['description']]);
            //$this->proyectModel->linkProyect([$_SESSION['id_usuario'],$this->proyectModel->lastInsertId()]);
            header("Location:" . BASE_URL . "series");
        }else{
            $this->proyectView->new_serie($this->errorModel->errorProyect());
        }
    }
    //Envía a el modelo el proyecto a eliminar
    public function deleteProyect(){
        $this->proyectModel->delete([$_POST['id_proyecto']]);
        header("Location:". BASE_URL . "proyects");
    }
    //Muestra error si no encuntra el action
    public function errorNotFound(){
        $this->errorModel->error404();
    }
}