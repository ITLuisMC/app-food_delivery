<?php
    $all_columnas = $app_db->get_all_columnas('usuarios');
    if (isset($_GET["delete-usuario"])) {
        $id = $_GET["delete-usuario"];
        if (check_hash("delete-usuario-$id",$_GET["hash"])){
            die('Intentando hackear!?');
        }
        $app_db->delete_columna($id,'usuarios');
        redirecto("admin/dashboard.php?action=list-usuarios&delete=$id");
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php require(__DIR__ .'/../components/head.php'); ?>

<body>

    <?php require(__DIR__ .'/../components/header.php'); ?>

    <div id="content">

        <h2>ADMINISTRACIÓN</h2>
        <h3>Usuarios</h3>

        <?php ?>

        <?php
            if (isset($_GET["success"])) {
                echo '<div class="success">El usuario fue creado</div>';
            } elseif (isset($_GET["update"])) {
                echo '<div class="success">El usuario fue actualizado</div>';
            } elseif (isset($_GET["delete"])) {
                $eId= $_GET['delete'];
                echo "<div class='error'>El usuario $eId fue borrado</div>";
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
                            if ($columna['id']!='1') {
                                ?><td><?php echo $value;?></td><?php
                            }
                        ?>
                    <?php endforeach; ?>

                    <?php
                        if ($columna['id']!='1') {
                            ?>
                                <td><a href="/admin/dashboard.php?action=list-usuarios&delete-usuario=<?php echo $columna['id'];?>&hash=<?php echo generate_hash('delete_usuario_'.$columna['id']);?>">Eliminar</a></td>
                                <td><a href="/admin/dashboard.php?action=edit-usuario&user=<?php echo $columna["username"];?>">Editar</a></td>
                            <?php
                        }
                    ?>
                    
                    
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?php require(__DIR__ .'/../components/footer.php'); ?>

</body>

</html>