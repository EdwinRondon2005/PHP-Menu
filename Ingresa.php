<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel = "stylesheet" href = "BTM.css">
    <link rel = "stylesheet" href = "PDO.css">
</head>
<body>
    <center>
        <h1>Registrar aparato</h1>
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
    <center>
		<form method = "post">
			<label>Código:</label>
			<input type = "text" name = "codigo" required>
			<label>Nombre:</label>
			<input type = "text" name = "nombre" required>
			<label>Precio:</label>
			<input type = "text" name = "precio" required>
			<label>Descripción:</label>
			<input type = "text" name = "descripcion" required>
			<label>Proveedor:</label>
			<input type = "text" name = "proveedor" required>
			<input type = "submit" value = "Registrar" class = "btn register">
		</form>
	</center>
    <br>

    <?php
		// Parámetros de la conexión a la base de datos.
		$host = "localhost";
		$dbname = "electrodomesticos";
		$username = "root";
		$password = "";

		// Crear una conexión a la base de datos utilizando PDO.
		try 
		{
	    	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	    	// Establecer el modo de error de PDO a excepción.
	    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch(PDOException $e) 
		{
	    	echo "Error en la conexión a la base de datos: " . $e->getMessage();
		}

		// Si se ha enviado el formulario, insertar los datos en la base de datos.
		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			try 
			{
				// Preparar la consulta SQL para insertar los datos en la tabla. 
				$stmt = $conn->prepare("INSERT INTO datos (codigo, nombre, precio, proveedor, descripcion) VALUES (:codigo, :nombre, :precio, :proveedor, :descripcion)");

				// Vincular los parámetros de la consulta con los valores enviados en el formulario.
				$stmt->bindParam(':codigo', $_POST['codigo']);
				$stmt->bindParam(':descripcion', $_POST['descripcion']);
				$stmt->bindParam(':nombre', $_POST['nombre']);
				$stmt->bindParam(':precio', $_POST['precio']);
				$stmt->bindParam(':proveedor', $_POST['proveedor']);
			

				// Ejecutar la consulta.
				$stmt->execute();

				// Mostrar un mensaje de éxito.
				echo "¡Ingresado con éxito!";
			} 
			catch(PDOException $e) 
			{
				// Mostrar un mensaje de error en caso de que la consulta falle.
				echo "Error al ingresar:" . $e->getMessage() ;
			}
		}

		// Cerrar la conexión a la base de datos.
		$conn = null;
	?>
</body>
</html>