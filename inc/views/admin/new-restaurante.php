<?php

$error = false;

switch ($action) {

    case 'edit-restaurante':
        
        $restaurante=$app_db->get_restaurante($_GET['restaurante']);
        
        $id = $restaurante['id'];
        $nombre = $restaurante['nombre'];
        $email = $restaurante['email'];
        $logo = $restaurante['logo'];
        $direccion = $restaurante['direccion'];
        $telefono = $restaurante['telefono'];
        $url_web = $restaurante['url_web'];
        $anuncio = $restaurante['anuncio'];
        
        break;
    default:
        $nombre = '';
        $email = '';
        $logo = '';
        $direccion = '';
        $telefono = '';
        $url_web = '';
        $anuncio = '';
        break;
}



if ( isset($_POST['submit-new-restaurante'])) {
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $logo = $_POST['logo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $url_web = $_POST['url_web'];
    $anuncio = $_POST['anuncio'];

    if( empty( $nombre ) || empty( $email ) ) {
        $error = true;
    } else {

        $app_db->insert_columna_restaurante($nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);
        
        redirecto('admin/dashboard.php?action=list-restaurantes&success=true');
    }

}

if ( isset($_POST['submit-edit-restaurante'])) {
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $logo = $_POST['logo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $url_web = $_POST['url_web'];
    $anuncio = $_POST['anuncio'];

    $app_db->update_restaurante($id,$nombre,$email,$logo,$direccion,$telefono,$url_web,$anuncio);
    
    redirecto('admin/dashboard.php?action=list-restaurantes&update=true');

}

?>

<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>

    <div id="content">

        <?php if( $action=='edit-restaurante' ): ?>
            <h2>Editar Restaurante</h2>
        <?php else: ?>
            <h2>Nuevo Restaurante</h2>
        <?php endif; ?>

        <?php if($error):?>
        <div class='error'>
            Error en el formulario
        </div>
        <?php endif; ?>

        <form name="formulario" method="post" action="">
            
            <label for="nombre">Nombre (requerido)</label>
            <input type="text" name="nombre" id="nombre" required value="<?php echo $nombre; ?>">

            <label for="email">Email (requerido)</label>
            <input type="email" name="email" id="email" required value="<?php echo $email; ?>">

            <label for="logo">Logo (requerido)</label>
            <input type="file" id="imagen" name="imagen" placeholder="Cambiar imagen" multiple>
            <input type="hidden" id="logo" name="logo" multiple required value="<?php echo $logo; ?>">
            
            <label for="direccion">direccion (requerido)</label>
            <input type="text" name="direccion" id="direccion" required value="<?php echo $direccion; ?>">

            <label for="telefono">telefono (requerido)</label>
            <input type="text" name="telefono" id="telefono" required value="<?php echo $telefono; ?>">

            <label for="url_web">url web (requerido)</label>
            <input type="text" name="url_web" id="url_web" required value="<?php echo $url_web; ?>">

            <label for="anuncio">Anuncio (requerido)</label>
            <textarea type="anuncio" name="anuncio" id="anuncio" cols=30 rows=30 required><?php echo $anuncio; ?></textarea>

            <p>
                <?php if( $action=='edit-restaurante' ): ?>
                    <button type="submit" name="submit-edit-restaurante" value="Editar Restaurante">Actualizar</button>
                <?php else: ?>
                    <button type="submit" name="submit-new-restaurante" value="Nuevo Restaurante">ENVIAR</button>
                <?php endif; ?>
            </p>

            <img src="" alt="" />

        </form>

    </div>

    <?php include(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>