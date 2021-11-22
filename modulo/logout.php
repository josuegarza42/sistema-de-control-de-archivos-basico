<?php
session_start();
session_destroy();
include("funciones.php");
header("location:" . $ruta . "portada.php");

?>
