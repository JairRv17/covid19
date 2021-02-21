<?php

$conn = new mysqli('127.0.0.1', 'root', '', 'covid19');
//nombre del servidor,  usuario, clave, base de datos
if ($conn === false) {
  die("Hubo un problema al conectarse a la base de datos " . mysqli_connect_error());
}