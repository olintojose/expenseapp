<?php

class Login extends Controller {
    function __construct(){
        parent::__construct();
        error_log('Login::contruct -> Inicio de Login');
    }
    function render(){
        $this->view->render('login/index');
    }
}
?>