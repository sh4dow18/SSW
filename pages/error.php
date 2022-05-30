<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Error</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css">
        <link rel="stylesheet" type="text/css" href="../css/logo.css">
        <link rel="stylesheet" type="text/css" href="../css/titles.css"> 
   </head>
    <body>
        <header>
            <a id="logo-header" class="logo"><img src="../images/logo.png" alt="logo" class="logo-img"><p class="logo-nombre">Sh4dow18 Streaming Website</p></a>
            <nav>
                <i class='fas fa-angle-left'></i></i><a href="../php/destroy.php" class="nav-link">Volver al Inicio</a>
            </nav>
        </header>
        <div id="title">
            <h1>Error</h1>
        </div>
        <?php
            if ($_GET['error'] == 'db') {
                echo "<h2>No se ha podido conectar con el servidor principal, vuelva a intentarlo</h2>";
            }
            else if ($_GET['error'] == 'privileges') {
                echo "<h2>Esta Pagina es solo para los Usuarios Autorizados</h2>";
            }
            else {
                echo "<h2>Esta Pagina es solo para los Usuarios Registrados</h2>";
            }
        ?>
    </body>
    <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
</html>