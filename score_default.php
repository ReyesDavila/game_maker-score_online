<?php

include 'datos_modificar.php';

//Proteccion por clave:
$usuario_get=$_POST["usuario"];
$clave_get=$_POST["clave"];

if($usuario==$usuario_get and $clave==$clave_get)
{
	//Organizador de score online
	//Leyendo archivo ini DEFAULT
	$contenido = parse_ini_file($archivo_ini_default, true);
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		$nombre[$i] = $contenido["score_$i2"]["nombre"];
		$nombre[$i] ="$nombre[$i]";
		$puntaje[$i] = $contenido["score_$i2"]["puntaje"];
	}
	
	//Escribiendo en archivo ini
	$fichero = fopen($archivo_ini,"w");
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		fputs($fichero,"[score_$i2]\n");
		fputs($fichero,"nombre=".'"'."$nombre[$i]".'"'."\n");
		fputs($fichero,"puntaje=$puntaje[$i]\n\n");	
	}
	fclose($fichero);

}//FIN //Proteccion por clave:

?>
