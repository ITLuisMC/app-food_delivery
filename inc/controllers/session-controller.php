<?php

    function redirecto($path){
        header('Location: ' . SITE_URL . '/' . $path);
		die();
    }
    
    function generate_hash($action) {
        return md5($action);
    }
    
    function check_hash($action,$hash) {

        if (generate_hash($action)===$hash) {
            return true;
        }
        
        return false;
        
    }
    
    function is_logged_in(){
    
        $session = isset($_SESSION['user']);
    
        return $session;
    
    }

    function login($username,$password){

        global $app_db;

        $usuario = $app_db->get_usuario($username);

        if (isset($usuario)){

            if ($username === $usuario['username'] && generate_hash($password) === $usuario['pass']) {
                $_SESSION['user']=[
                    'username'=>$usuario['username'],
                    'rol'=>$usuario['rol']
                ];
                return true;
            }
        }

        return false;
    }

    function logout(){
        unset($_SESSION['user']);
        redirecto('index.php');
        session_destroy();
    }