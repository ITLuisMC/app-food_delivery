<table>
    <tr>
        <?php foreach ($usuario as $columna => $value) : ?>
            <th><?php echo $columna;?></th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($usuario as $columna => $value) : ?>
            <td><?php echo $value;?></td>
        <?php endforeach; ?>
        
    </tr>
    <ul>
        <li><a href="/admin/dashboard.php?action=edit-usuario">Editar</a></li>
    </ul>
</table>