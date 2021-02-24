<?php
include_once('header.php');

?>
<div class="container">
    <div class="col-12">
        <h1>Informacion</h1>
    </div>
    <div class="col-12">
        <table class="table table-hover" id="table_id">
            <thead>
                <tr>
                        
                    <th scope="col">Nombre</th>
                    <th scope="col">Actualizaciones</th>
                    <th scope="col">Fecha actualización</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //$query = $conn->query("SELECT sin.Nombre, sin.Fecha, exa.Nombre, exa.Fecha FROM paciente AS pac, sintomas AS sin, examenes AS exa WHERE 1 = sin.Id_user AND exa.Id_user");
                $query = $conn->query("SELECT pac.PrimerNombre , age.Examenes, age.Fecha, age.Sintomas, age.Fecha
                FROM paciente AS pac, agenda AS age
                WHERE pac.Id = 1 AND pac.Id = age.Id_user;");
                while ($valores = mysqli_fetch_array($query)) {

                    if($valores[1] != NULL){
                        echo "<tr>";
                        echo "<td>" . $valores[0] . "</td>";
                        echo "<td>" . $valores[1] . "</td>";
                        echo "<td>" . $valores[2] . " " . "</td>";
                        echo "</tr>";
                    }
                    
                    if($valores[3] != NULL){
                        echo "<tr>";        
                        echo "<td>" . $valores[0] . "</td>";            
                        echo "<td>" . $valores[3] . "</td>";
                        echo "<td>" . $valores[4] . "</td>";
                        echo "</tr>";
                    }
                    
                }

                ?>
            </tbody>
        </table>
    </div>

</div>

<?php
include_once('footer.php');
?>