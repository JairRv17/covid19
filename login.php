<?php
include_once('conexion.php');

if (isset($_POST["txtUsuario"]) && isset($_POST["txtPassword"])) {
    $nombre = $_POST["txtUsuario"];
    $pass = $_POST["txtPassword"];
    echo "isset txtUsuario  && isset txtPassword ";
}

if (isset($_POST['btnLogin']) || isset($_GET['nombre']) ) {
    //echo "btn Login || modo";
    //echo "<script> alert(Entré)</script>";
    //echo "Nombre: ".$_GET['nombre'];
    //echo "<br>Pass: ".$_GET['pass']."<br>";
    if(isset($_GET['nombre']) && isset($_GET['pass'])){
        $nombre = $_GET['nombre'];
        $pass = $_GET['pass'];
    }
    $query = mysqli_query($conn, "SELECT * FROM credenciales WHERE usuario = '" . $nombre . "' and contraseña = '" . $pass . "'");
    $valores = mysqli_fetch_array($query);
    $nr = mysqli_num_rows($query);
    //echo "nr ". $nr . "<br>";
    //echo "<script> alert(nr =". $nombre .")</script>";
    if ($nr == 1) {
        //echo "Bienvenido: " . $_SESSION['user'] . "<br>";
        //echo "ID: " . $_SESSION['id'];
        session_start();
        $_SESSION['user'] = $nombre;
        $id_cred = $valores['Id'];
        //echo $_SESSION['id_cred'];
        if(isset($_GET['nombre'])){
            echo "<script>alert('Hello! I am an alert box!!');</script>";
            //echo "<br>Dentro de header";
            header("Location: registrar.php?id_Cred=$id_cred");
        }else{
            header("Location: index.php");
        }
    } else if ($nr == 0) {
        //header("Location: login.html");
        //echo "No ingreso"; 
        //echo "MODO = ".$modo;
        echo "<script> alert('USUARIO NO REGISTRADO/ DATOS INCORRECTOS --- Vuelva a intentar');
		window.location= 'login.php' </script>";
    }
}
if(!isset($_GET['nombre'])){
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
<?php } ?>