<?php

    require(__DIR__ .'/../inc/init.php');
    
    if (!is_logged_in()){
        redirecto('user/login.php');
        die();
    }

    $usuario=$app_db->get_usuario($_SESSION['user']['username']);
    
    $action = isset($_GET['action']) ? $_GET["action"] : '';

    switch ($action) {

        default:
            require(__DIR__ .'/../inc/views/user/inicio.php');
            break;
    }
    
?>
