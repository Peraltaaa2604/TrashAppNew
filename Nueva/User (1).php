  <?php
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    session_start();
    include("Conexion.php");

    $buscarusuario = "SELECT * FROM clientes WHERE Correo='$correo'";
    $result = $con->query($buscarusuario); 
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $hash=$row['Contrasena'];
    if (password_verify($contrasena, $hash)) {
      $_SESSION['loggedin'] = true;
      $_SESSION['Correo'] = $correo;
      $_SESSION['start'] = time();
      $_SESSION['expire'] = $_SESSION['start']; 
      header('Location: http://localhost/Nueva/Panel_control.php');
    }else{
      echo "Contraseña o usuario incorrecto";
      echo "<br><a href='Index.html'>Volver a Intentarlo</a>";
    }

    mysqli_close($con);
  ?>