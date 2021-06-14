<?php

    if (isset($_GET["delete-post"])) {
        $id = $_GET["delete-post"];
        if (check_hash("delete-post-$id",$_GET["hash"])){
            die('Intentando hackear!?');
        }
        $app_db->delete_columna($id,'posts');
        redirecto("admin/?action=list-posts&delete=$id");
    }

?>
<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>
    <div id="content">

        <h2>HOME</h2>

        <?php
            if (isset($_GET["success"])) {
                echo '<div class="success">El post fue creado</div>';
            } elseif (isset($_GET["update"])) {
                echo '<div class="success">El usuario fue actualizado</div>';
            } elseif (isset($_GET["delete"])) {
                $eId= $_GET['delete'];
                echo "<div class='error'>El post $eId fue borrado</div>";
            }
        ?>
        
        <?php require(__DIR__ .'/../components/tabla-usuario.php'); ?>

    </div>

    <?php require(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>