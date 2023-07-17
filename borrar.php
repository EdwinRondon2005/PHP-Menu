<!DOCTYPE html>
<html>
  <meta charset = "UTF-8">
    <head>
      <title>Leer o borrar datos de los electrodomésticos registrados</title>
      <link rel = "stylesheet" href = "BTM.css">
      <link rel = "stylesheet" href = "PDO.css">
    </head>
  <body>
    <center>
      <h1>Leer o borrar datos</h1>
    </center>
    <hr>
    <div id = "header">
        <ul class = "nav">
            <li><a href = "Prueba.html">Inicio</a></li>
            <li><a href = "">Operaciones</a>
            <ul>
                <li><a href = "ingresa.php">Registrar</a></li>
                <li><a href = "lectura.php">Mostrar registros</a></li>
                <li><a href = "borrar.php">Borrar registros</a></li>
                <li><a href = "actualizar.php">Actualizar registros</a></li>
            </ul></li>
            <li><a href = "Acerca de.html">Acerca de</a></li>
        </ul>
    </div>
    <table border = "1">
      <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Descripción</th>
        <th>Proveedor</th>
        <th>Borrar</th>
      </tr>
      <?php
        // Conectarse a la base de datos.
        $conexion = mysqli_connect("localhost", "root", "", "electrodomesticos");

        // Verificar si la conexión fue exitosa.
        if(!$conexion) 
        {
          die("Error de conexión: " . mysqli_connect_error());
        }

        // Verificar si se ha enviado un ID de registro para borrar.
        if(isset($_GET["borrar"])) 
        {
          $codigo = $_GET["borrar"];
          $consulta = "DELETE FROM datos WHERE codigo = $codigo";
          $resultado = mysqli_query($conexion, $consulta);

          // Verificar si el borrado fue exitoso.
          if($resultado) 
          {
            echo "<p style = 'text-align:center'>¡Registro borrado exitosamente!</p><br>";
          } 
          else 
          {
            echo "Error al borrar el registro: " . mysqli_error($conexion);
          }
        }

        // Consultar los datos de la tabla.
        $consulta = "SELECT codigo, nombre, precio, descripcion, proveedor FROM datos";
        $resultado = mysqli_query($conexion, $consulta);
        // Verificar si la consulta fue exitosa.
        if (!$resultado) 
        {
          die("Error de consulta: " . mysqli_error($conexion));
        }

        // Mostrar los datos en una tabla HTML.
        while ($fila = mysqli_fetch_assoc($resultado)) 
        {
          echo "<tr>";
          echo "<td>" . $fila["codigo"] . "</td>";
          echo "<td>" . $fila["nombre"] . "</td>";
          echo "<td>" . $fila["precio"] . "</td>";
          echo "<td>" . $fila["descripcion"] . "</td>";
          echo "<td>" . $fila["proveedor"] . "</td>";
          echo "<td><a href=\"?borrar=" . $fila["codigo"] . "\">Borrar</a></td>";
          echo "</tr>";
        }

        // Cerrar la conexión a la basede datos.
        mysqli_close($conexion);
      ?>
    </table>
  </body>
</html>