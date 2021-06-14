<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>
    <div id="content">

        <h2>ADMINISTRACIÓN</h2>

        <ul>
            <li><a href="?action=list-restaurantes">Listado de restaurantes</a></li>
            <li><a href="?action=list-usuarios">Listado de usuarios</a></li>
            <br>
            <li><a href="?action=new-restaurante">Nuevo restaurante</a></li>
            <li><a href="?action=new-usuario">Nuevo usuario</a></li>
        </ul>

    </div>

    <?php require(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>