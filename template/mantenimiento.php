<?php
include_once('header.php');
?>

<?php

if (isset($_POST['btnGrabar'])) {

    $examen = $_POST['txtExamenes'] == "" ? NULL : $_POST['txtExamenes'];
    $sintoma = $_POST['txtSintomas'] == "" ? NULL : $_POST['txtSintomas'];
    $medicina = $_POST['txtMedicinas'] == "" ? NULL : $_POST['txtMedicinas'];
    $novedad = $_POST['txtNovedades'] == "" ? NULL : $_POST['txtNovedades'];

    //$script = "INSERT INTO `credenciales` (`Usuario`, `Contraseña`) VALUES ('" . $nombre . "', '" . $pass . "')";
    $script = "INSERT INTO `agenda` (`Id_user`, `Examenes`, `Sintomas`, `Medicinas`, `Novedades`, `Fecha`) VALUES ('" . $_SESSION['id'] . "', '" . $examen . "', '" . $sintoma . "', '" . $medicina . "', '" . $novedad . "', current_timestamp());";
    //echo $script;
    if ($conn->query($script) === TRUE) {
        echo '<script>
            alert("Datos guardados");
            window.location= "index.php";
            </script>';
    } else {
        echo '<script>
            alert("Error inesperado");
            </script>';
    }
    $conn->close();
}
if (isset($_GET["modo"])) {
    $modo = $_GET["modo"] == "" ? "D" : $_GET["modo"];
    if ($modo == "D") {
        session_unset();
        session_destroy();
        echo "<script>window.location= '../login.php' </script>";
        //header("Location: ../login.php");
    } else if ($modo == "Nuevo") { ?>
        <div class="container">
            <div class="col-12">
                <h1><?php echo $modo ?> Registro</h1>
            </div>
            <div class="col-12">
                <form method="POST" action="mantenimiento.php">
                    <div class="mb-3">
                        <label for="txtSintomas" class="form-label">Síntomas</label>
                        <input type="text" class="form-control" id="txtSintomas" name="txtSintomas">
                    </div>
                    <div class="mb-3">
                        <label for="txtExamenes" class="form-label">Exámenes</label>
                        <input type="text" class="form-control" id="txtExamenes" name="txtExamenes">
                    </div>
                    <div class="mb-3">
                        <label for="txtMedicinas" class="form-label">Medicinas</label>
                        <input type="text" class="form-control" id="txtMedicinas" name="txtMedicinas">
                    </div>
                    <div class="mb-3">
                        <label for="txtNovedades" class="form-label">Novedades</label>
                        <input type="text" class="form-control" id="txtNovedades" name="txtNovedades">
                    </div>
                    <button type="submit" name="btnGrabar" class="btn btn-success">Grabar</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php
    } else if ($modo != "D" && $modo != "Nuevo") {
        ?>
            <div class="container">
                <div class="col-12">
                    <h1><?php echo $modo ?></h1>
                </div>
                <div class="col-12">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo $modo ?></th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $conn->query("SELECT age.Examenes, age.Fecha, age.Sintomas, age.Medicinas, age.Novedades
                                        FROM paciente AS pac, agenda AS age
                                        WHERE pac.Id = " . $_SESSION['id'] . " AND pac.Id = age.Id_user;");
                            while ($valores = mysqli_fetch_array($query)) {

                                if ($modo == "Examenes") {
                                    if ($valores[0] != NULL) {
                                        echo "<tr>";
                                        echo "<td>" . $valores[0] . "</td>";
                                        echo "<td>" . $valores[1] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                if ($modo == "Sintomas") {
                                    if ($valores[2] != NULL) {
                                        echo "<tr>";
                                        echo "<td>" . $valores[2] . "</td>";
                                        echo "<td>" . $valores[1] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                if ($modo == "Medicinas") {
                                    if ($valores[3] != NULL) {
                                        echo "<tr>";
                                        echo "<td>" . $valores[3] . "</td>";
                                        echo "<td>" . $valores[1] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                if ($modo == "Novedades") {
                                    if ($valores[4] != NULL) {
                                        echo "<tr>";
                                        echo "<td>" . $valores[4] . "</td>";
                                        echo "<td>" . $valores[1] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

    <?php
    }
}
include_once('footer.php');
    ?>