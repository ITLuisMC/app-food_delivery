<?php
    //REPORTE DE ERRORES
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    //LOCALIZACIÓN
    define ( 'SITE_URL', 'http://localhost:8073');
    define ( 'SITE_TIMEZONE', 'Europe/Madrid');
    define ( 'SITE_LANG', ['es', 'spa', 'es_ES']);
    //CONEXIÓN BASE DE DATOS
    define ( 'DB_HOST', 'db');
    define ( 'DB_USER', 'root');
    define ( 'DB_PASS', '');
    define ( 'DB_DATABASE', 'just_eat');
    define ( 'DB_PORT', '');