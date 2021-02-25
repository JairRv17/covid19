<?php
include_once('header.php');
?>
<?php
if (isset($_POST["btnGrabar"])) {
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    /***************************/
    $PrimerNombre = $_POST["txtPrimerNombre"];
    $SegundoNombre = $_POST["txtSegundoNombre"];
    $PrimerApellido = $_POST["txtPrimerApellido"];
    $SegundoApellido = $_POST["txtSegundoApellido"];
    $FechaNacimiento = $_POST["txtFechaNacimiento"];
    $Estatura = $_POST["txtEstatura"];
    $Cedula = $_POST["txtCedula"];
    $Sexo = $_POST["rbSexo"];
    $Sangre = $_POST["txtSangre"];
    $id = $_SESSION['id'];
    /***************************/
    $script = "UPDATE `paciente` SET 
        `PrimerNombre`= '$PrimerNombre', 
        `SegundoNombre`= '$SegundoNombre', 
        `PrimerApellido`= '$PrimerApellido', 
        `SegundoApellido`= '$SegundoApellido', 
        `FechaNacimiento`= '$FechaNacimiento', 
        `Sexo`= '$Sexo', 
        `Estatura`= '$Estatura', 
        `Cedula`= '$Cedula', 
        `TipoSangre`= '$Sangre'
         WHERE `paciente`.`Id` = $id;";

    if ($conn->query($script) === TRUE) {
        echo '<script>
            alert("Registro Guardado Exitosamente");
            window.location= "index.php";
            </script>';;
    } else {
        echo '<script>
            alert("Error inesperado");
            window.location= "index.php";
            </script>';
    }
    $conn->close();
}
$query = $conn->query("SELECT * FROM paciente where Id=" .$_SESSION['id']);
while ($valores = mysqli_fetch_array($query)) {
    $primer_nombre = $valores['PrimerNombre'];
    $segundo_nombre = $valores['SegundoNombre'];
    $primer_apellido = $valores['PrimerApellido'];
    $segundo_apellido = $valores['SegundoApellido'];
    $fecha_nacimiento = $valores['FechaNacimiento'];
    $sexo = $valores['Sexo'];
    $estatura = $valores['Estatura'];
    $cedula = $valores['Cedula'];
    $sangre = $valores['TipoSangre'];
}
?>
<form method="POST" action="Act_Date.php">
    <div class="container">
        <div class="mb-3">
            <label for="txtPrimerNombre" class="form-label">Primer Nombre</label>
            <input type="text" class="form-control" id="txtPrimerNombre" value="<?php echo $primer_nombre; ?>" name="txtPrimerNombre">
        </div>
        <div class="mb-3">
            <label for="txtSegundoNombre" class="form-label">Segundo Nombre</label>
            <input type="text" class="form-control" id="txtSegundoNombre" value="<?php echo $segundo_nombre; ?>" name="txtSegundoNombre">
        </div>
        <div class="mb-3">
            <label for="txtPrimerNombre" class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" id="txtPrimerApellido" value="<?php echo $primer_apellido; ?>" name="txtPrimerApellido">
        </div>
        <div class="mb-3">
            <label for="txtSegundoApellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="txtSegundoApellido" value="<?php echo $segundo_apellido; ?>"name="txtSegundoApellido">
        </div>
        <div class="mb-3">
            <label for="txtFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="txtFechaNacimiento" value="<?php echo $fecha_nacimiento; ?>"name="txtFechaNacimiento">
        </div>
        <div class="mb-3">
            <label for="txtEstatura" class="form-label">Estatura</label>
            <input type="number" step="0.01" class="form-control" id="txtEstatura" value="<?php echo $estatura; ?>"name="txtEstatura">
        </div>
        <div class="mb-3">
            <label for="txtCedula" class="form-label">Cedula</label>
            <input type="text" class="form-control" id="txtCedula" name="txtCedula" minlength="10" maxlength="10" value="<?php echo $cedula; ?>">
        </div>
        <div class="mb-3">
            <label for="rbSexo" class="form-label" >Sexo</label>
            <div class="container">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="M" name="rbSexo" id="rbSexoM" <?php echo ($sexo == "M" ? "checked" : ""); ?>>
                    <label class="form-check-label" for="rbSexoM">
                        Masculino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="F" name="rbSexo" id="rbSexoF" <?php echo  ($sexo == "F" ? "checked" : ""); ?>>
                    <label class="form-check-label" for="rbSexoF">
                        Femenino
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="txtSangre" class="form-label">Tipo de Sangre</label>
            <input type="text" class="form-control" id="txtSangre" name="txtSangre"value="<?php echo $sangre; ?>">
        </div>
        <button type="submit" name="btnGrabar" class="btn btn-success">Grabar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
<?php
include_once('footer.php');
?>