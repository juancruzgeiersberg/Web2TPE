<?php

class ErrorModel{
    //error 404
    public function error404(){
        return "Error 404 not found.";
    }
    //error en registro vacio
    public function errorRegister(){
        return "You must complete all fields.";
    }
    //error de usuario o contraseña incorrectos en login
    public function errorLoginIncorrect(){
        return "User or Password Incorrect.";
    }
    //error de login vacio
    public function errorLoginVoid(){
        return "You must enter User and Password.";
    }
    //error de que el usuario ya existe
    public function errorUserExists(){
        return "User already exists";
    }
    //error de nombre de proyecto vacio
    public function errorProyect(){
        return "You must enter a serie name.";
    }
    //error de usuario inexistente
    public function errorUserNotExists(){
        return "Username does not exist.";
    }
}
