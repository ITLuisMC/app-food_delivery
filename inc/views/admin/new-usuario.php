<?php

$error = false;
switch ($action) {

    case 'edit-usuario':
        
        if(isset($_GET['user'])){
            $usuario=$app_db->get_usuario($_GET['user']);
        } else {
            $usuario=$app_db->get_usuario($_SESSION['user']['username']);
        }
        $nombre = $usuario['username'];
        $email = $usuario['email'];
        $pass = $usuario['pass'];
        if ($_SESSION['user']['rol']=='administrador') {
            $rol = $usuario['rol'];
        }
        break;
    default:

        $nombre = '';
        $email = '';
        $pass = '';
        $rol = 'usuario';
        break;
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
        redirecto('admin/dashboard.php?action=list-usuarios&success=true');
    }

}

if ( isset($_POST['submit-edit-usuario'])) {

    $id = $usuario['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    if ($pass == $_POST['pass']) {
        $pass = $_POST['pass'];
    } else {
        $pass = generate_hash($_POST['pass']);
    }
    
    if ($_SESSION['user']['rol']=='administrador') {
        $rol = $_POST['rol'];
    } else {
        $rol = 'usuario';
    }

    $app_db->update_campos_usuario($id,$nombre,$email,$pass,$rol);
    
    redirecto('user/home.php?update=true');
    

}

?>

<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>

    <div id="content">
        <?php if( $action=='edit-usuario' ): ?>
            <h2>Editar Usuario</h2>
        <?php else: ?>
            <h2>Crear nuevo Usuario</h2>
        <?php endif; ?>
        

        <?php if($error):?>
        <div class='error'>
            Error en el formulario
        </div>
        <?php endif; ?>

        <form name="formulario" method="post" action="">
            
            <?php if( $action=='edit-usuario' ): ?>
                <label for="nombre">Nombre Usuario (requerido)</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">

                <label for="email">email</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">

                <label for="pass">Contraseña</label>
                <input required type="password" name="pass" id="pass" value="<?php echo $pass; ?>">
            <?php else: ?>
                <label for="nombre">Nombre Usuario (requerido)</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">

                <label for="email">email (requerido)</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">

                <label for="pass">Contraseña (requerido)</label>
                <input required type="password" name="pass" id="pass" value="<?php echo $pass; ?>">
            <?php endif; ?>
            
            

            <?php if ($_SESSION['user']['rol']=='administrador') {?>
                <label for="rol">Rol</label>
                <select name="rol">
                    <option selected value="<?php echo $rol; ?>"><?php echo $rol; ?></option>
                    <option value="usuario">usuario</option>
                    <option value="administrador">administrador</option>
                </select><?php
            }?>
            
            <p>
                <?php if( $action=='edit-usuario' ): ?>
                    <button type="submit" name="submit-edit-usuario" value="Editar Usuario">Actualizar</button>
                <?php else: ?>
                    <button type="submit" name="submit-new-usuario" value="Nuevo Usuario">ENVIAR</button>
                <?php endif; ?>

            </p>

        </form>

    </div>

    <?php include(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>