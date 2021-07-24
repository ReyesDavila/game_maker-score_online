<?php

include 'datos_modificar.php';

//Proteccion por clave:
$usuario_get=$_POST["usuario"];
$clave_get=$_POST["clave"];

if($usuario==$usuario_get and $clave==$clave_get)
{
	//Organizador de score online
	//Leyendo archivo ini
	$contenido = parse_ini_file($archivo_ini, true);
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		$nombre[$i] = $contenido["score_$i2"]["nombre"];
		$nombre[$i] ="$nombre[$i]";
		$puntaje[$i] = $contenido["score_$i2"]["puntaje"];
	}
	
	//visualizando salida
	for($i=0;$i<$cantidad_elementos;$i++)
	{
	$i2=$i+1;
echo "[score_$i2]
nombre=".'"'.$nombre[$i].'"'."
puntaje=$puntaje[$i]

";

	}
}//FIN //Proteccion por clave:

?>
