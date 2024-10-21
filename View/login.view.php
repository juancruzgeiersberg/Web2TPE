<?php

class LoginView{

    //Vista del login
    public function showLogin($error = null){
        require_once 'templates/header.phtml';
    
        require_once 'templates/login.phtml';
    
        require_once 'templates/footer.phtml';
    }
    
    
}


?>