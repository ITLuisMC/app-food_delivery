<?php

    require(__DIR__ .'/../inc/init.php');
    
    if (!is_logged_in()){
        redirecto('user/login.php');
        die();
    }
    
    $action = isset($_GET['action']) ? $_GET["action"] : '';

    switch ($action) {
        
        case 'list-usuarios':
            require(__DIR__ .'/../inc/views/admin/list-usuarios.php');
            break;
        case 'list-restaurantes':
            require(__DIR__ .'/../inc/views/admin/list-restaurantes.php');
            break;
        case 'new-restaurante':
            require(__DIR__ .'/../inc/views/admin/new-restaurante.php');
            break;
        case 'edit-restaurante':
            require(__DIR__ .'/../inc/views/admin/new-restaurante.php');
            break;
        case 'new-usuario':
            require(__DIR__ .'/../inc/views/admin/new-usuario.php');
            break;
        case 'edit-usuario':
            require(__DIR__ .'/../inc/views/admin/new-usuario.php');
            break;
        default:
            require(__DIR__ .'/../inc/views/admin/admin.php');
            break;
    }
    
?>
