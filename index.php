<?php

    require('inc/init.php');
    
    if (isset($_GET["delete-post"])) {

        $id = $_GET["delete-post"];

        if (check_hash("delete-post-$id",$_GET["hash"])){
            die('Intentando hackear!?');
        }
        
        $app_db->delete_columna($id,'posts');
        
        redirecto("?delete=$id");

    }
    
    $all_columnas = $app_db->get_all_columnas('restaurantes');

    $found = false;

    if (isset($_GET["view"])) {
        
        $found = $app_db->get_columna($_GET["view"],'restaurantes');

        if ($found) {
            $all_columnas = [$found];
        } else {
            echo "no id";
        }

    }

    if ( isset($_POST['submit-pedido']) ) {

        if (!is_logged_in()){
            redirecto('user/login.php?aviso=true');
            die();
        }
        
        $restaurante = $found["nombre"];

        $usuario = $_SESSION['user']['username'];
        $pedido = $_POST['submit-pedido'];

        $suma_pedidos = intval($found['n_pedidos'])+1;
        
        $app_db->insert_pedido($restaurante,$usuario,$pedido);


        $app_db->update_pedidos_restaurante($suma_pedidos,$found['id']);

        redirecto('?pedido=true');
    
    }

?>

<!DOCTYPE html>
<html lang="en">

<?php require('inc/views/components/head.php'); ?>

<body>

    <?php
    require('inc/views/components/header.php');
    ?>

    <div id="content">

        <?php
            
            if (isset($_GET["pedido"])) {
                echo "<div class='success'>Tu pedido se ha realizado con exito!</div>";
            }
            
        ?>

        <div class="posts">

            <?php foreach ($all_columnas as $columna) : ?>

            <?php require('inc/views/components/articulo-restaurante.php'); ?>

            <?php endforeach; ?>

        </div>

    </div>

    <?php require('inc/views/components/footer.php'); ?>

</body>

</html>