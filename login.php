<?php
include_once('conexion.php');

//session_start();

if (isset($_POST["txtUsuario"]) && isset($_POST["txtPassword"])) {
    $nombre = $_POST["txtUsuario"];
    $pass = $_POST["txtPassword"];
    session_start();
    $_SESSION['user'] = $nombre;
}

if (isset($_POST['btnLogin'])) {
    $query = mysqli_query($conn, "SELECT * FROM credenciales WHERE usuario = '" . $nombre . "' and contraseña = '" . $pass . "'");
    $valores = mysqli_fetch_array($query);
    $nr = mysqli_num_rows($query);
    if ($nr == 1) {
        //echo "Bienvenido: " . $_SESSION['user'] . "<br>";
        //echo "ID: " . $_SESSION['id'];
        $_SESSION['id'] = $valores['Id'];
        header("Location: index.php");
    } else if ($nr == 0) {
        //header("Location: login.html");
        //echo "No ingreso"; 
        echo "<script> alert('USUARIO NO REGISTRADO/ DATOS INCORRECTOS --- Vuelva a intentar');
		window.location= 'login.php' </script>";
    }
}
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styles/styles.css">

    <title>Login</title>
</head>

<body>
    <div class="login">
        <h1>Iniciar Sesion</h1>
        <form method="POST" action="login.php">
            <input type="text" name="txtUsuario" placeholder="Nombre De Usuario" />
            <input type="password" name="txtPassword" placeholder="Contraseña" />
            <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-large">Entrar</button>
            <a class="btn btn-primary btn-block btn-large" href="registrar.php"> Registrar </a>
        </form>
    </div>
</body>

</html>