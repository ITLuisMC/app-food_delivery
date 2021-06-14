<?php
    //COMPRUEBO EXISTENCIA DE ARCHIVO CONFIG, SINO EXISTE ERROR.
    if (!file_exists(__DIR__ .'/config/config.php')) {
        die("No existe config.php");
    } else {
        require(__DIR__ .'/config/config.php');
    }
    //////////////-----------------------------------
    //INICIO SESSION
    session_start();
    //////////////-----------------------------------
    //INSTANCIO Y CONECTO CON MARIADB PARA COMPROBAR SI YA ESTA CREADA LA BASE DE DATOS, SINO ES ASI LA CREO Y CIERRO LA CONEXIÓN PARA VOLVER A CONECTAR ESTA VEZ YA HACIENDOLO DIRECTAMENTE CON LA BS DE LA APLICACIÓN.
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    $base_datos = DB_DATABASE;
    $test = mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS $base_datos") ;
    if (!$test) {
        echo ('error');
        die(mysqli_error($mysqli));
    }
    mysqli_close($mysqli);
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    //////////////-----------------------------------
    // REQUIRE's
    require(__DIR__ .'/data/img/imagenes.php');
    require(__DIR__ .'/controllers/mysql-controller.php');
    require(__DIR__ .'/controllers/session-controller.php');
    //instancio la clase controladora de la base de datos:
    $app_db = new App_db;
    $demo_restaurantes = new Imagenes_Demo;
    //////////////-----------------------------------
    // COMPROBACIÓN DE INICIO: CREO LAS TABLAS Y COLUMNAS AUTOMATICAMENTE SI ESTAS NO EXISTEN Y AÑADO ALGUNAS FILAS PARA DEMO.
    if (!$app_db->comprobar_tabla('restaurantes')) {
        $app_db->crear_tabla_restaurantes();
        $app_db->insert_demo_restaurantes();
    }
    if (!$app_db->comprobar_tabla('usuarios')) {
        $app_db->crear_tabla_usuarios();
        $app_db->insert_columna_usuario('admin','info@admin','admin','administrador');
        $app_db->insert_columna_usuario('usuario','info@usuario','usuario','usuario');
    }
    if (!$app_db->comprobar_tabla('pedidos')) {
        $app_db->crear_tabla_pedidos();
    }
    //////////////-----------------------------------
    //-LOGOUT
    if (isset($_GET['logout'])) {
        logout();
    }
    //////////////-----------------------------------