<?php

    class App_db {
        
        //ARRANQUE INICIO
        public function get_query($query){

            global $mysqli;
    
            $resultado = mysqli_query( $mysqli, $query);

            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
            return mysqli_fetch_all($resultado,MYSQLI_ASSOC);
    
        }
        public function comprobar_bd($nombre){
            
            $mysqli_t = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

            $resultado = mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS $nombre") ;

            if (!$resultado) {
                echo ('error');
                die(mysqli_error($resultado));
            }

            mysql_close($mysqli_t);

        }
        public function comprobar_tabla($nombre){

            global $mysqli;

            $resultado = mysqli_query($mysqli, "show tables like '$nombre'") ;

            if (!$resultado) {
                echo ('error');
                die(mysqli_error($resultado));
            }

            if (mysqli_num_rows($resultado)==0) {
                
                return false;
            }
            
            return true;

        }
        //DEMO: INSERTA RESTAURANTES PARA
        public function insert_demo_restaurantes(){

            global $mysqli;
            global $app_db;
            global $demo_restaurantes;
            
            $nombre = "Hamburgueseria1";
            $email = "info@$nombre";
            $logo = $demo_restaurantes->get_hamburguesa();
            $direccion = "C/ $nombre";
            $telefono = "555-55-55-55";
            $url_web = "www.$nombre.com";
            $anuncio = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
            
            $app_db->insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);

            $nombre = "Vegetariano1";
            $email = "info@$nombre";
            $logo = $demo_restaurantes->get_verdura();
            $direccion = "C/ $nombre";
            $telefono = "555-55-55-55";
            $url_web = "www.$nombre.com";
            $anuncio = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
            
            $app_db->insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);

            $nombre = "Pizzeria1";
            $email = "info@$nombre";
            $logo = $demo_restaurantes->get_pizza();
            $direccion = "C/ $nombre";
            $telefono = "555-55-55-55";
            $url_web = "www.$nombre.com";
            $anuncio = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
            
            $app_db->insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);

            $nombre = "Marisqueria1";
            $email = "info@$nombre";
            $logo = $demo_restaurantes->get_pescado();
            $direccion = "C/ $nombre";
            $telefono = "555-55-55-55";
            $url_web = "www.$nombre.com";
            $anuncio = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
            
            $app_db->insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);

        }
        //////////////-----------------------------------
        //GENERALES
        public function get_all_columnas($tabla){

            global $mysqli;
    
            $resultado = mysqli_query( $mysqli, "SELECT * FROM $tabla");
            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
            return mysqli_fetch_all($resultado,MYSQLI_ASSOC);
    
        }
        public function get_columna($id,$tabla){
    
            global $mysqli;
            
            $id = intval($id);
    
            $query = "SELECT * FROM $tabla WHERE id=".$id;
            $resultado = mysqli_query( $mysqli, $query);
    
            
            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
            return mysqli_fetch_assoc($resultado);
    
        }
        public function delete_columna($id,$tabla){
    
            global $mysqli;

            $id = intval($id);
    
            $resultado = mysqli_query( $mysqli, "DELETE FROM $tabla WHERE id='$id';");
    
            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
        }
        //////////////-----------------------------------
        //USUARIOS
        public function crear_tabla_usuarios(){

            global $mysqli;
            
            $query = "CREATE TABLE usuarios (
                id smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                username varchar(255) NOT NULL,
                pass text NOT NULL,
                email text NOT NULL,
                rol text NOT NULL
            )";
    
            $resultado = mysqli_query( $mysqli, $query);

            if (!$resultado) {
                die(mysqli_error($mysqli));
            }

        }
        public function insert_columna_usuario($nombre,$email,$pass,$rol){
    
            global $mysqli;
            
            $nombre = mysqli_real_escape_string($mysqli,$nombre);
            $email = mysqli_real_escape_string($mysqli,$email);
            $pass = generate_hash(mysqli_real_escape_string($mysqli,$pass));
            $rol = mysqli_real_escape_string($mysqli,$rol);
    
            $query = "INSERT INTO usuarios
            ( username,email,pass,rol ) VALUES
            ( '$nombre','$email','$pass','$rol')";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }
    
        }
        public function update_campos_usuario($id,$nombre,$email,$pass,$rol){
    
            global $mysqli;
            
            $id=intval($id);
            $nombre = mysqli_real_escape_string($mysqli,$nombre);
            $email = mysqli_real_escape_string($mysqli,$email);
            $pass = mysqli_real_escape_string($mysqli,$pass);
            $rol = mysqli_real_escape_string($mysqli,$rol);
            
            $query = "UPDATE usuarios SET username='$nombre',email='$email',pass='$pass',rol='$rol' WHERE id=$id";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }
    
        }
        public function get_usuario($usuario){
            global $mysqli;
            
            $usuario = $usuario;
    
            $query = "SELECT * FROM usuarios WHERE username='$usuario'";
            $resultado = mysqli_query( $mysqli, $query);
            
            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
            return mysqli_fetch_assoc($resultado);
        }
        //////////////-----------------------------------
        //RESTAURANTES
        public function crear_tabla_restaurantes(){

            global $mysqli;

            $query = "CREATE TABLE restaurantes (
                id smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                nombre varchar(255) NOT NULL,
                email text NOT NULL,
                logo LONGBLOB NOT NULL,
                direccion text NOT NULL,
                telefono text NOT NULL,
                url_web text NOT NULL,
                carta varchar(255) NOT NULL,
                anuncio text NOT NULL,
                n_pedidos int
            )";
    
            $resultado = mysqli_query( $mysqli, $query);

            if (!$resultado) {
                die(mysqli_error($mysqli));
            }

        }
        public function insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio){
            
            global $mysqli;
            
            $carta = array(
                'menu1' => array(
                    'plato1',
                    'plato2',
                    'plato3'
                ),
                'menu2' => array(
                    'plato1',
                    'plato2',
                    'plato3'
                ),
                'menu3' => array(
                    'plato1',
                    'plato2',
                    'plato3'
                )
            );

            $array = array(
                'nombre'=>mysqli_real_escape_string($mysqli,$nombre),
                'email'=>mysqli_real_escape_string($mysqli,$email),
                'logo'=>mysqli_real_escape_string($mysqli,$logo),
                'direccion'=>mysqli_real_escape_string($mysqli,$direccion),
                'telefono'=>mysqli_real_escape_string($mysqli,$telefono),
                'url_web'=>mysqli_real_escape_string($mysqli,$url_web),
                'carta'=>json_encode($carta),
                'anuncio'=>mysqli_real_escape_string($mysqli,$anuncio)
            );
            
            $nombre = $array['nombre'];
            $email = $array['email'];
            $logo = $array['logo'];
            $direccion = $array['direccion'];
            $telefono = $array['telefono'];
            $url_web = $array['url_web'];
            $carta = $array['carta'];
            $anuncio = $array['anuncio'];
            $pedidos = 0;
    
            $query = "INSERT INTO restaurantes
            ( nombre,email,logo,direccion,telefono,url_web,carta,anuncio,n_pedidos ) VALUES
            ( '$nombre','$email','$logo','$direccion','$telefono','$url_web','$carta','$anuncio', $pedidos)";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }
    
        }
        public function update_restaurante($id,$nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio){
    
            global $mysqli;
            
            $id=intval($id);
            $nombre = mysqli_real_escape_string($mysqli,$nombre);
            $email = mysqli_real_escape_string($mysqli,$email);
            $logo = mysqli_real_escape_string($mysqli,$logo);
            $direccion = mysqli_real_escape_string($mysqli,$direccion);
            $telefono = mysqli_real_escape_string($mysqli,$telefono);
            $url_web = mysqli_real_escape_string($mysqli,$url_web);
            $anuncio = mysqli_real_escape_string($mysqli,$anuncio);
    
            $query = "UPDATE restaurantes SET nombre='$nombre',email='$email',logo='$logo',direccion='$direccion',telefono='$telefono',url_web='$url_web',anuncio='$anuncio' WHERE id=$id";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }
    
        }
        public function get_restaurante($restaurante){

            global $mysqli;
            
            $restaurante = $restaurante;
    
            $query = "SELECT * FROM restaurantes WHERE nombre='$restaurante'";
            $resultado = mysqli_query( $mysqli, $query);
            
            if (!$resultado) {
                die(mysqli_error($resultado));
            }
    
            return mysqli_fetch_assoc($resultado);
        }
        public function update_pedidos_restaurante($numero,$id){

            global $mysqli;

            $query = "UPDATE restaurantes SET n_pedidos='$numero' WHERE id=$id";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }

        }
        //////////////-----------------------------------
        //PEDIDOS
        public function crear_tabla_pedidos(){
            
            global $mysqli;
            
            $query = "CREATE TABLE pedidos (
                id smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                restaurante text NOT NULL,
                usuario text NOT NULL,
                pedido text NOT NULL
            )";
    
            $resultado = mysqli_query( $mysqli, $query);

            if (!$resultado) {
                die(mysqli_error($mysqli));
            }

        }
        public function insert_pedido($restaurante,$usuario,$pedido){
            
            global $mysqli;

            $array = array(
                'restaurante'=>mysqli_real_escape_string($mysqli,$restaurante),
                'usuario'=>mysqli_real_escape_string($mysqli,$usuario),
                'pedido'=>mysqli_real_escape_string($mysqli,$pedido)
            );
            
            $restaurante = $array['restaurante'];
            $usuario = $array['usuario'];
            $pedido = $array['pedido'];
    
            $query = "INSERT INTO pedidos
            ( restaurante,usuario,pedido ) VALUES
            ( '$restaurante','$usuario','$pedido' )";
            
            $resultado = mysqli_query($mysqli,$query);
    
            if(!$resultado){
                die(mysqli_error($mysqli));
            }
    
        }
        
    }