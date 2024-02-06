<html>
 <head>
 <title>
 Listado de Personas
 </title>
 </head>
<body>
 <table border="1">
 <tr bgcolor="blue">
 <td align="center"><a href="index.php?coding=true">Codigo</a></td>
 <td align="center"><a href="index.php?nombres=true">Nombre</a></td>
 <td align="center"><a href="index.php?anios=true">Edad</a></td>
 </tr>
 <br>
 <a href="form.html">Insertar registros</a>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'Lab7')
 or die ("no se pudo conectar " . mysqli_last_error($connection));

$sql = "SELECT * FROM personas";
if (isset($_GET['coding']) && $_GET['coding'] == 'true')
{
	
    $sql .= " ORDER BY codigo";
}
elseif (isset($_GET['nombres']) && $_GET['nombres'] == 'true')
{
    	
    $sql .= " ORDER BY nombre";
}
elseif (isset($_GET['anios']) && $_GET['anios'] == 'true')
{
    	
    $sql .= " ORDER BY edad";
}
$result = mysqli_query($connection,$sql);
while ($row = mysqli_fetch_row($result)) {
$codigo=$row[0];
$nombre=$row[1];
$edad=$row[2];
print ("<tr>");
print ("<td>$codigo</td>");
print ("<td>$nombre</td>");
print ("<td>$edad</td>");
print ("</tr>");
}
mysqli_close($connection);
?>
 </table>
</body>
</html>