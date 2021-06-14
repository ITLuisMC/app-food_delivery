<div>
    <?php if ($error) :?>
    <div class='error'>
        <?php echo 'Error de usuario o contraseña';?>
    </div>
    <?php endif;?>

    <form action="" method="post">
        <h2>Login</h2>
        <label for="username">Usuario</label>
        <input type="text" name="username" id="username" placeholder="demo: usuario o admin">

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="demo: usuario o admin">

        <input type="hidden" name="hash" value="<?php
                    echo htmlspecialchars(generate_hash('login'), ENT_QUOTES );
                ?>">

        <p>
            <input type="submit" value="Login" name="submit-login">
        </p>

    </form>
</div>