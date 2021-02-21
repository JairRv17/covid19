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