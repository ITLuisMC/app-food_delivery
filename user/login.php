<?php

    require(__DIR__ .'/../inc/init.php');

    $error = false;
    
    if (isset($_POST["submit-login"])) {

        if (!check_hash("login",$_POST["hash"])){
            die('Intentando hackear!?');
        }
        
        if (!login($_POST['username'],$_POST['password'])) {
            $error = true;
        }

        if (is_logged_in()){
            switch ($_SESSION['user']['rol']) {
                case 'administrador':
                    redirecto('admin/dashboard.php');
                    break;
                default:
                    redirecto('/');
                    break;
            }
        }

    }

    if ( isset($_POST['submit-new-usuario'])) {

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $rol = 'usuario';
    
        if( empty( $nombre ) || empty( $email ) || empty( $pass ) ) {
            $error = true;
        } else {
            $app_db->insert_columna_usuario($nombre,$email,$pass,$rol);
            
            if (!login($nombre,$pass)) {
                $error = true;
            }

            if (is_logged_in()){
                redirecto('');
            }
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../inc/views/components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../inc/views/components/header.php');?>

    <div id="content">
        <?php
            if (isset($_GET["aviso"])) {
                echo "<div class='error'>Debe estar registrado/logeado para poder realizar pedidos.</div>";
            }
        ?>
    </div>

    <div id="content" class="enlinea">
    
        <?php require(__DIR__ .'/../inc/views/components/formulario-login.php');?>
        <?php require(__DIR__ .'/../inc/views/components/formulario-registro.php');?>
    </div>
    <?php require(__DIR__ .'/../inc/views/components/footer.php'); ?>
</body>
</html>