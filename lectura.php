<!DOCTYPE html>
<html>
  <meta charset = "UTF-8">
    <head>
      <title>Visualización de aparatos</title>
      <link rel = "stylesheet" href = "BTM.css">
      <link rel = "stylesheet" href = "PDO.css">
    </head>
  <body>
    <center>
      <h1>Lista de electrodomésticos</h1>
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
  
  <?php
    // Conexión a la base de datos.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "electrodomesticos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión.
    if ($conn->connect_error) 
    {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos de la tabla.
    $sql = "SELECT * FROM datos";
    $result = $conn->query($sql);

    // Crear la tabla HTML para mostrar los datos.
    if ($result->num_rows > 0) 
    {
      echo '<table border = 1>';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Código</th>';
      echo '<th>Nombre</th>';
      echo '<th>Precio</th>';
      echo '<th>Descripción</th>';
      echo '<th>Proveedor</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      // Recorrer los resultados y mostrarlos en la tabla.
      while($row = $result->fetch_assoc()) 
      {
        echo '<tr>';
        echo '<td>' . $row["codigo"] . '</td>';
        echo '<td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["precio"] . '</td>';
        echo '<td>' . $row["descripcion"] . '</td>';
        echo '<td>' . $row["proveedor"] . '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
    } 
    else 
    {
      echo '<p>No se encontraron datos.</p>';
    }
    $conn->close();
  ?>
  <br><br><br><br>
  </body>
</html>