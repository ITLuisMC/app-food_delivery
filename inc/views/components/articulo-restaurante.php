<article class="post">

    <header>
        <h2 class="post-title">
            <a href="?view=<?php echo $columna['id'];?>">
                <?php echo $columna['nombre'];?>
            </a>
        </h2>
        <img src="data:image/jpg;base64,<?php echo $columna['logo'] ?>"/>
    </header>
    
    <div class="post-content">
        <p><?php echo $columna['anuncio'];?></p>
        <?php if( $found ): ?>
            <?php require(__DIR__ .'/tabla-restaurante.php'); ?>
        <?php endif; ?>
    </div>

    <footer>
        
        <?php if( $found ): ?>
            <h3>CARTA</h3>
            <form action="" method="post">

                <table>

                    <?php $menus = json_decode ($columna['carta']);?>
                    
                        <?php foreach ($menus as $menu=>$value) : ?>
                            <tr>
                            <th><?php echo $menu ;?></th>
                            <?php foreach ($value as $plato) : ?>
                                <td><?php echo $plato ;?></td>
                            <?php endforeach; ?>
                            <td>
                                <button type="submit" name="submit-pedido" value="<?php echo $menu; ?>"><?php echo "Pedir $menu"; ?></button>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    

                    <tr>
                        
                    </tr>
                </table>
                
            </form>
        <?php endif; ?>
        
    </footer>

</article>