<div>
    <h2>Registro</h2>

    <?php if($error):?>
        <div class='error'>
            Error en el formulario
        </div>
    <?php endif; ?>

    <form name="formulario" method="post" action="">
    
        <label for="nombre">Nombre Usuario (requerido)</label>
        <input type="text" name="nombre" id="nombre" value="">

        <label for="email">email (requerido)</label>
        <input type="email" name="email" id="email" value="">

        <label for="pass">Contraseña (requerido)</label>
        <input type="password" name="pass" id="pass" value="">

        <p>
            <button type="submit" name="submit-new-usuario" value="Nuevo Usuario">ENVIAR</button>
            <button type="reset">LIMPIAR</button>
        </p>

    </form>
</div>