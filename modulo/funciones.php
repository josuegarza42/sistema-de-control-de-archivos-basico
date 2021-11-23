<?php
function conectarBD()
{
    // CONEXION CON LA base de datos
    $conn = mysqli_connect("localhost", "root", "", "deswebdocumentos");
    return $conn;
}
$ruta = "http://localhost/modulo/";

function rolDeUsuario($idUsuario)
{
    $con = conectarBD();
    $rs = mysqli_query($con, "select Rol from usuarios where idUsuario=" . $idUsuario);
    $datoUrs = mysqli_fetch_object($rs);
    mysqli_close($con);
    return $datoUrs->Rol;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

</body>

</html>