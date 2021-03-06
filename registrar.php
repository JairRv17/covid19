<?php
$title = "Nuevo registro";
include_once('header.php');
?>

<?php
echo "<h1>" . $title . "</h1>";
if (isset($_POST["btnGrabar"])) {
    $paciente = $_GET["paciente"] == "" ? "F" : $_GET["paciente"];
    if($paciente == "F"){
        //echo $_POST["rbSexo"];
        //echo "<br>".$_POST['txtIdCred'];
        
        $script = "INSERT INTO `paciente` (`PrimerNombre`, `SegundoNombre`, `PrimerApellido`, `SegundoApellido`, `FechaNacimiento`, `Sexo`, `Estatura`, `Cedula`, `TipoSangre`, `id_credencial`) ";
        //$script .= " VALUES ('Kevin', 'Fabricio', 'Vega', 'Sacaira', '2000-02-10', 'M', '1.73', '0926454778', 'O+', '25');";
        $script .= " VALUES ('" . $_POST["txtPrimerNombre"] . "', '" . $_POST["txtSegundoNombre"] . "', '" . $_POST["txtPrimerApellido"] . "', '" . $_POST["txtSegundoApellido"] . "', '" . $_POST["txtFechaNacimiento"] . "', '".$_POST["rbSexo"]."', '" . $_POST["txtEstatura"] . "', '" . $_POST["txtCedula"] . "','".$_POST["txtSangre"] . "', '" . $_POST["txtIdCred"] . "')";
        echo $script;
        if ($conn->query($script) === TRUE) {
            session_start();
            $query = $conn->query("SELECT paciente.Id FROM `paciente` INNER JOIN `credenciales` ON  paciente.id_credencial = " . $_SESSION['id_cred'] . ";");
            $valores = mysqli_fetch_array($query);
            $_SESSION['id'] = $valores[0];
            echo '<script>
            alert("Se agrego un nuevo registro exitosamente");
            window.location= "index.php"
            </script>';
        } else {
            echo "Error al conectarse a la base de datos" . mysqli_connect_error();

        }
        $conn->close();
    }
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    if ($paciente == "I") {

        $nombre = $_POST["txtUsuario"];
        $pass = $_POST["txtPassword"];
        $script = "INSERT INTO `credenciales` (`Usuario`, `Contraseña`) VALUES ('" . $nombre . "', '" . $pass . "')";

        //echo "Hola";

        if ($conn->query($script) === TRUE) {
            echo '<script>
            alert("Se ha registrado correctamente")</script>';
            header("Location: login.php?nombre=$nombre&pass=$pass");
            //echo '<script> window.location= "login.php?nombre='.$nombre.'</script>';//''&pass='.$pass.'</script>';
        } else {
            echo '<script>
            alert("Error inesperado");
            </script>';
        }
        $conn->close();
    }
}
    if(isset($_GET['id_Cred'])){
        $id_cred = $_GET['id_Cred'];
        //echo $id_cred;
        //session_start();
?>
        <form method="POST" action="registrar.php?paciente=">
            <div class="mb-3">
                <label for="txtPrimerNombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" id="txtPrimerNombre" name="txtPrimerNombre">
            </div>
            <div class="mb-3">
                <label for="txtSegundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="txtSegundoNombre" name="txtSegundoNombre">
            </div>
            <div class="mb-3">
                <label for="txtPrimerNombre" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" id="txtPrimerApellido" name="txtPrimerApellido">
            </div>
            <div class="mb-3">
                <label for="txtSegundoApellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="txtSegundoApellido" name="txtSegundoApellido">
            </div>
            <div class="mb-3">
                <label for="txtFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="txtFechaNacimiento" name="txtFechaNacimiento">
            </div>
            <div class="mb-3">
                <label for="txtEstatura" class="form-label">Estatura</label>
                <input type="number" step="0.01" class="form-control" id="txtEstatura" name="txtEstatura">
            </div>
            <div class="mb-3">
                <label for="txtCedula" class="form-label">Cedula</label>
                <input type="text" class="form-control" id="txtCedula" name="txtCedula" minlength="10" maxlength="10">
            </div>
            <div class="mb-3">
                <label for="rbSexo" class="form-label">Sexo</label>
                <div class="container">    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="M" name="rbSexo" id="rbSexoM">
                        <label class="form-check-label" for="rbSexoM">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="F" name="rbSexo" id="rbSexoF">
                        <label class="form-check-label" for="rbSexoF">
                            Femenino
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="txtSangre" class="form-label">Tipo de Sangre</label>
                <input type="text" class="form-control" id="txtSangre" name="txtSangre">
            </div>
            <!--<label for="txtIdCred" class="form-label">Id Credencial</label>-->
            <input type="hidden" class="form-control" id="txtIdCred" name="txtIdCred" value="<?php echo $id_cred; ?>">
            
            <button type="submit" name="btnGrabar" class="btn btn-success">Grabar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form><?php
            }
        
                ?>

<?php if ((!isset($_GET['paciente'])) && (!isset($_GET['id_Cred']))) { ?>
    <form method="POST" action="registrar.php?paciente=I">
        <div class="mb-3">
            <label for="txtusuario" class="form-label">Crear Nombre de Usuario</label>
            <input type="text" class="form-control" id="txtUsuario" name="txtUsuario">
        </div>
        <div class="mb-3">
            <label for="txtcontra" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
        </div>
        <div class="botones">
            <button type="submit" name="btnGrabar" class="btn btn-success">Siguiente</button>
            <a href="login.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
<?php
}
include_once('footer.php');
?>