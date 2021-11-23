<?php
session_start();

include("funciones.php");
$msg = "";
// usuario no autenticado
if (!isset($_SESSION['idU'])) {
    header("location:" . $ruta . "verUsuarios.php");
}
// AUTORIZACION
$rolUsr = rolDeUsuario($_SESSION["idU"]);
// SI NO ES ADMI SACALO
if ($rolUsr != "Administrador") {
    header("location:" . $ruta . "verUsuarios.php");
}
//si no esta definido el rol ni el usuario sacalo
if (!isset($_GET["txtRol"]) && !isset($_GET["txtUsuario"])) {
    header("location:" . $ruta . "verUsuarios.php");
}
//si estan vacios
if ($_GET["txtRol"] == "" || $_GET["txtUsuario"] == "") {
    header("location:" . $ruta . "verUsuarios.php");
}

$qry = "Update usuarios set Rol=' " . $_GET["txtRol"] . " ' where idUsuario= " . $_GET["txtUsuario"];

$c = conectarBD();
mysqli_query($c, $qry);
mysqli_close($c);
header("location:" . $ruta . "verUsuarios.php");
?>