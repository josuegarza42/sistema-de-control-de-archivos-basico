<?php
session_start();
include("funciones.php");

$msg = "";
if (isset($_POST['txtUsuario']) && isset($_POST['txtPwd'])) {
    if ($_POST['txtUsuario'] != "" && $_POST['txtPwd'] != "") {
        // conectar a la bd para verifcar que el usuario y contraseña son correctos
        $c = conectarBD();
        //    hacemos la consulta
        $qry = "select * from usuarios where Usuario= '" . $_POST['txtUsuario'] . "' and Pwd= '" . $_POST['txtPwd'] . "' ";
        $rs = mysqli_query($c, $qry);
        if (mysqli_num_rows($rs) > 0) {
            // si si autentico
            $datosUsuario = mysqli_fetch_array($rs);
            // via get
            // header("location:http://localhost/modulo/portada.php?idU=" . $datosUsuario["idUsuario"]);
            // establecer sesion en el servidor= se manda por aca lo confidencial
            $_SESSION['idU'] = $datosUsuario["idUsuario"];
            $_SESSION['nombre'] = $datosUsuario["Usuario"];
            header("location:http://localhost/modulo/portada.php");
        } else {
            // no fueron correctos
            $msg = "El usuario o la contraseña no fueron correctos";
        }
    }
}
?>

<div>
    <?php
    if ($msg != "") {
        echo $msg;
    }
    ?>
</div>