<?php
include_once('header.php');
?>

<?php
if (isset($_POST["btnGrabar"])) {
    $paciente = $_GET["paciente"] == "" ? "F" : $_GET["paciente"];
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    if ($paciente == "I") {
        $pass = $_POST["txtPassword"];
        $id=$_SESSION['id'];
        $script = "UPDATE 
        `credenciales` SET 
        `Contraseña` = '$pass' WHERE `credenciales`.`Id` = $id;";
        if ($conn->query($script) === TRUE) {
            echo '<script>
            alert("Se ha registrado correctamente");
            window.location= "index.php";
            </script>';
           
        } else {
            echo '<script>
            alert("Error inesperado");
             window.location= "index.php";
            </script>';
        
        }
        $conn->close();
    }
}
if (isset($_GET['id_Cred'])) {
    $id_cred = $_GET['id_Cred'];
?>

<?php
}

?>
<div class="container">
    <?php if ((!isset($_GET['paciente'])) && (!isset($_GET['id_Cred']))) { ?>
        <form method="POST" action="Act_Pass.php?paciente=I">
            <div class="mb-3">
                <label for="txtcontra" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder=<?php "SELECT * FROM `credenciales` WHERE Contraseña" ?>>
            </div>
            <div class="botones">
                <button type="submit" name="btnGrabar" class="btn btn-success">Confirmar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
</div>
<?php
    }

    include_once('footer.php');
?>