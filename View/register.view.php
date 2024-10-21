<?php


//Hay que cambiar el formato de la vista del registro, esto solo es para poder ver sin que dé error.

class RegisterView{
    //Vista del register
    public function showRegister($error=""){
        require_once 'templates/header.phtml';
    
        require_once 'templates/register.phtml';
    
        require_once 'templates/footer.phtml';
    }

}


?>