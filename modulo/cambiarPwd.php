<?php
session_start();
include("funciones.php");
$msg = "";
// validar si esta autenticado
if (!isset($_SESSION["idU"])) {
    header("location:" . $ruta . "login.php");
}

// VALIDACION SERVIDOR
// SI SE PASARON LOS DATOS POR FORMULARIO
if (isset($_POST["txtPwdActual"]) && isset($_POST["txtNewPwd"]) &&  isset($_POST["txtReNewPwd"])) {
    if ($_POST["txtPwdActual"] != "" && $_POST["txtNewPwd"] != "" && $_POST["txtPwdActual"] != "") {
        // procedemos a la actualizacion de la info
        // abrimos la coneccion a bd
        $c = conectarBD();
        $qry = "update usuarios set Pwd=
        '" . $_POST["txtNewPwd"] . "' where idUsuario= " . $_SESSION['idU'] . " and Pwd= '" . $_POST["txtPwdActual"] . "'";
        mysqli_query($c,$qry);
        $msg="La contraseña se actualizo correctamente";
        mysqli_close($c);
    }
}

?>

<!-- Validacion por CLIENTE -->
<script type="text/javascript">
    function validaFRM() {
        if (document.getElementById("txtPwdActual").value == "" ||
            document.getElementById("txtNewPwd").value == "" ||
            document.getElementById("txtReNewPwd").value == "") {

            alert("todos los datos deben de estar llenos");
            return false;
        } else if (document.getElementById("txtNewPwd").value != document.getElementById("txtReNewPwd").value) {
            document.getElementById("txtMsg").innerHTML = "Las NUEVAS contraseñas deben de ser iguales";
            document.getElementById("txtPwd").value == "";
            document.getElementById("txtRepwd").value == "";
            return false;
        } else {
            return true;
        }
    }
</script>

<body>

    <h2 class="tituloSistema">FORMULARIO DE ACTUALIZACION DE CONTRASEÑA</h2>

    <form method="post" action="cambiarPwd.php" onsubmit=" return validaFRM()">
        <?php
        if ($msg != "") {
            echo "<div id=\"txtMsg\"class=\"err\">$msg</div>";
        } else {
            echo  "<div id=\"txtMsg\"></div>";
        }
        ?>

        Ingresa tu CONTRASEÑA ACTUAL: <input type="password" id="txtPwdActual" name="txtPwdActual"> <br>
        Escribe tu nueva contraseña: <input type="password" id="txtNewPwd" name="txtNewPwd"><br>
        Reescribe la nueva contraseña: <input type="password" id="txtReNewPwd" name="txtReNewPwd"><br>

        <input type="submit" value="Actualiza">
        <input type="reset" value="Cancelar"> <br>
        <button><a href="portada.php">Regresar</a></button>

    </form>
</body>

</html>