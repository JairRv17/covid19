<?php 
    include_once('header.php');
    include_once('archivos/opcion.php');
$informacion = [];

$info = new opcion();
$info->Act_Inic = "Paracetamol";
$info->Fecha_Inic = "23/02/2021 21-52";
array_push($informacion, $info);

//$juego2 = new opcion();
//$juego2->id = 2;
//$juego2->nombre = "Ghost of Tsushima";
//$juego2->genero = "Acción";
//$juego2->precio = 55.00;
//$juego2->clasificacion = "16+";
//$juego2->imagen = "img/ghost.jpg";
//array_push($juegos, $juego2);


?>
<div class="container">
    <div class="col-12">
        <h1>Informacion</h1>
    </div>
    <div class="col-12">
        <table class="table table-hover" id="table_id">
            <thead>
                <tr>
                    <th scope="col">Actualizaciones</th>
                    <th scope="col">Fecha actualizacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($informacion as $Muestra_Info) {
                    echo "<tr>";
                    echo "  <td>" . $Muestra_Info->Act_Inic . "</td>";
                    echo "  <td>" . $Muestra_Info->Fecha_Inic . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php 
    include_once('footer.php');
?>