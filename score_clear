<?php

include 'datos_modificar.php';

//Proteccion por clave:
$usuario_get=$_POST["usuario"];
$clave_get=$_POST["clave"];

if($usuario==$usuario_get and $clave==$clave_get)
{
	//Escribiendo en archivo ini
	$fichero = fopen($archivo_ini,"w");
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		fputs($fichero,"[score_$i2]\n");
		fputs($fichero,"nombre=".'"'."nobody".'"'."\n");
		fputs($fichero,"puntaje=0\n\n");	
	}
	fclose($fichero);
}//FIN //Proteccion por clave:

?>
