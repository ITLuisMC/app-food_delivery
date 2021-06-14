<?php

    $all_columnas = $app_db->get_all_columnas('restaurantes');

    if (isset($_GET["delete-restaurante"])) {

        $id = $_GET["delete-restaurante"];

        if (check_hash("delete-restaurante-$id",$_GET["hash"])){
            die('Intentando hackear!?');
        }

        $app_db->delete_columna($id,'restaurantes');
        
        redirecto("admin/dashboard.php?action=list-restaurantes&&delete=$id");
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>
    <div id="content">

        <h2>ADMINISTRACIÓN</h2>
        <h3>Restaurantes</h3>

        <?php ?>

        <?php
            if (isset($_GET["success"])) {
                echo '<div class="success">El restaurante fue creado</div>';
            } elseif (isset($_GET["delete"])) {
                $eId= $_GET['delete'];
                echo "<div class='error'>El restaurante $eId fue borrado</div>";
            } elseif (isset($_GET["update"])) {
                echo "<div class='success'>El restaurante fue actualizado</div>";
            }
        ?>

        <table>
            <tr>
                <?php foreach ($all_columnas as $columna => $value) : ?>
                    <?php
                        if ($columna==0) {
                            foreach ($value as $campo => $valor) {
                                ?><th><?php echo $campo;?></th><?php
                            }
                        }
                    ?>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($all_columnas as $columna) : ?>
                <tr>
                
                    <?php foreach ($columna as $campo => $value) : ?>
                        <?php
                            if ($campo=='id'||$campo=='nombre'||$campo=='n_pedidos') {
                                ?><td><?php echo $value;?></td><?php
                            } else {
                                if (!$value) {
                                    ?><td>NO</td><?php
                                }else {
                                    ?><td>SI</td><?php
                                }
                            }
                        ?>
                        
                    <?php endforeach; ?>

                    <td><a href="/admin/dashboard.php?action=edit-restaurante&restaurante=<?php echo $columna["nombre"];?>">Editar</a></td>

                    <td><a href="?action=list-restaurantes&delete-restaurante=<?php echo $columna['id'];?>&hash=<?php echo generate_hash('delete_restaurante_'.$columna['id']);?>">Eliminar</a></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?php require(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>