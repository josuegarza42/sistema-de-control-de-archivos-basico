<?php
session_start();
include("funciones.php");
$msg = "";
// validar si esta autenticado
if (!isset($_SESSION["idU"])) {
    header("location:" . $ruta . "login.php");
}

if (isset($_GET["idA"]) && $_GET["idA"] !=="") {
    // recuperacion del rol
    $rolUsr = rolDeUsuario($_SESSION["idU"]);

    // responder con la imagen
    $c = conectarBD();
    if ($rolUsr == "General") {
        $qry = "Select NombreOriginal, Tipo, Contenido from documentos where idDocumento=" . $_GET["idA"] . " and idUsuario=" . $_GET["idU"];
    } else if ($rolUsr == "Administrador") {
        $qry = "Select NombreOriginal, Tipo, Contenido from documentos where idDocumento="  . $_GET["idA"];
    }
    $rs = mysqli_query($c, $qry);
    $imagen = mysqli_fetch_array($rs);
    header("Content-type:" . $imagen["Tipo"]);
    header("Content-Disposition: attachment; filename=" . $imagen["NombreOriginal"]);
    echo $imagen["Contenido"];
    mysqli_close($c);
}
?>
