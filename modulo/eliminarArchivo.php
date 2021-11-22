<?php
session_start();

include("funciones.php");
$msg = "";
// usuario autenticado
if (!isset($_SESSION['idU'])) {
    header("location:" . $ruta . "portada.php");
}

// 

// verificar que se envio el id del documento a eliminar

if (isset($_GET['idA']) && $_GET['idA'] != "") {
    if (rolDeUsuario($_SESSION["idU"]) == "Administrador") {
        $qry = "delete from documentos where idDocumento" . $_GET["idA"];
    } else {
        $qry = "delete from documentos where idDocumento" . $_GET["idA"] . "and idUsuario " . $_SESSION["idU"];
    }

    $c = conectarBD();
    mysqli_query($c, $qry);
    mysqli_close($c);
    header("location:" . $ruta . "portada.php");
}
