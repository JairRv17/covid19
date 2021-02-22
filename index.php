<?php
    session_start();
    echo "<h1>Hola " . $_SESSION['user'] . "</h1>";
    echo "<h1>Hola " . $_SESSION['id_cred'] . "</h1>";

?>