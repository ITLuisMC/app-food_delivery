<nav id="site-navigation" class="row row-center" role="navigation">
    <div class="column">
        <h1>
            <a href="/"></a>
        </h1>
        <ul class="main-menu column clearfix">

            <li><a href="/">Inicio</a></li>
            
            <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['rol']=='administrador') {
                    $eUser = $_SESSION['user'];
                    echo "<li><a href='/user/home.php'>Home</a></li>";
                    echo "<li><a href='/admin/dashboard.php'>Administración</a></li>";
                    echo "<li><a href='/?logout=true'>Logout</a></li>";
                } else if (isset($_SESSION['user']) && $_SESSION['user']['rol']=='usuario') {
                    $eUser = $_SESSION['user'];
                    echo "<li><a href='/user/home.php'>Home</a></li>";
                    echo "<li><a href='/?logout=true'>Logout</a></li>";
                } else {
                    echo "<li><a href='/user/login.php'>Login/Registro</a></li>";
                }
            ?>
            
        </ul>
    </div>
</nav>