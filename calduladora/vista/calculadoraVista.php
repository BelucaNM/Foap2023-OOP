<html>

	<head>
		<title> Ejercicio 2</title>
		<meta charset="utf-8" >
  		<meta description="Basecon favicon">
  		<link rel="shortcut icon" href="./imagenes/faviconTest.png">
  		
  	<style>
	</style>
	</head>

	
<body>
	<h1> Ejercicio Calculadora</h1>
    <div id="frase">
    <form  method="POST" action = "../includes/calc.php">
        Entre un número: <input type="integer" name="numero1" value="<?php echo '';?>"><br>
        Entre un número: <input type="integer" name="numero2" value="<?php echo '';?>"><br>
        <label for="idOperacion">Seleccione Operación:</label>
        <select name="operacion" id="idOperacion">
            <option value="suma" selected="selected" >Suma</option>
            <option value="resta">Resta</option>
            <option value="producto">Producto</option>
            <option value="division">Division</option>
        </select>
        <input type="submit" name= "submit" value="Calcular"> 

    </form>
    </div>
   
	</body>


</html>