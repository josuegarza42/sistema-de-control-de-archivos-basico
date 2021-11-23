<?php
session_start();
include("funciones.php");
// si NO esta autenticado
if (!isset($_SESSION['idU'])) {
    header("location:" . $ruta . "portada.php");
}
// AUTORIZACION
$rolUsr = rolDeUsuario($_SESSION["idU"]);
// SI NO ES ADMI SACALO
if ($rolUsr != "Administrador") {
    header("location:" . $ruta . "portada.php");
}

if (isset($_SESSION['idU'])) {
    echo "<h2 class='bienvenida'>BIENVENIDO " . $_SESSION['nombre'] . " </h2>";

    if ($rolUsr == "Administrador") {
        // COLOCAR EL MENU ADMINISTRADOR
        echo "<div class=\"opcionesMenu\">
        <a href=\"cargarArchivo.php\">  [cargar archivo]</a> 
        | <a href=\"cambiarPwd.php\">[cambiar contraseña]</a>  
        | <a href=\"verUsuarios.php\">[Listar usuario]</a>  
        | <a href='logout.php'> [salir del sistema]</a> </div>";

        echo "<h3>LISTAR LOS USUARIOS DEL SISTEMA</h3>";
        $qry = "Select idUsuario, Usuario, Rol, Email from usuarios";
    }
    // echo $qry;
    $c = conectarBD();
    $rs = mysqli_query($c, $qry);
    // resultado de la consulta
    if (mysqli_num_rows($rs) > 0) {
        // si hay USUARIOS
        echo "<table>";
        echo  "<tr>";
        echo  "<td>USUARIO</td>";
        echo  "<td>ROL</td>";
        echo  "<td>CORREO ELECTRONICO</td>";
        echo  "<td>opciones</td>";
        echo  "</tr>";

        while ($datos = mysqli_fetch_array($rs)) {
            echo  "<tr>";
            echo  "<td> " . $datos["Usuario"] . " </td>";
            echo  "<td> ";

?>
            <form method="get" action="actualizaRol.php">
                <select name="txtRol" id="txtRol">
                    <?php
                    if ($datos["Rol"] == "Administrador") {
                        echo "<option selected value=\"Administrador\">Administrador</option>";
                        echo "<option value=\"General\">General</option>";
                    } else if ($datos["Rol"] == "General") {
                        echo "<option value=\"Administrador\">Administrador</option>";
                        echo "<option selected value=\"General\">General</option>";
                    }
                    ?>
                </select>
                <input type="hidden" value="<?php echo $datos["idUsuario"] ?>" name="txtUsuario">
                <input type="submit" value="Actualizar">
            </form>
    <?php

            echo "</td>";
            echo  "<td>" . $datos["Email"] . "</td>";

            echo  "<td> <a href=\"eliminarUsuario.php?idA=" . $datos["idUsuario"] . "\">Eliminar</a>  </td>";
            echo  "</tr>";
        }
        echo  "</table>";
    } else {
        // no hay documentos guardados
        echo "ACTUALMENTE NO HAY DOCUMENTOS GUARDADOS";
    }
} else {
    ?>

    <body>
        <h1 class="tituloSistema"> Sistema de control de archivos</h1>
        <?php
        // espacion de autenticacion
        ?>
        <p>NECESITAS AUTENTICARTE</p>
        <form method="POST" action="login.php">
            Usuario: <input type="text" name="txtUsuario" id="txtUsuario"> <br>
            Contraseña: <input type="password" name="txtPwd" id="txtPwd"><br>
            <input type="submit" name="" id="" value="Autenticame">
            <input type="reset" name="" id="" value="cancelar"> <br>
            <a href="registro.php">Si no esta registrado da click aqui</a>
        </form>
    <?php
}
    ?>
    </body>

    </html>