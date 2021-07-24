<?php

include 'datos_modificar.php';

//Proteccion por clave:
$usuario_get=$_POST["usuario"];
$clave_get=$_POST["clave"];

if($usuario==$usuario_get and $clave==$clave_get)
{

	///////////////////////////////////////////////  OBTENIENDO DATOS

	//Organizador de score online
	//Leyendo archivo ini
	$archivo =$archivo_ini;
	$contenido = parse_ini_file($archivo, true);
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		$nombre[$i] = $contenido["score_$i2"]["nombre"];
		$nombre[$i] ="$nombre[$i]";
		$puntaje[$i] = $contenido["score_$i2"]["puntaje"];
		$nombre_salida[$i] ="";
		$puntaje_salida[$i] =0;
		$orden_mayor_menor[$i]=0;
	}

	//observando salida
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		echo "[score_$i2]: <br>";
		echo "$nombre[$i] <br>";
		echo "$puntaje[$i] <br><br>";
	}




	///////////////////////////////////////////////  COMPARANDO NUMEROS

	//Reiniciando calificacion
	for($i=0;$i<$cantidad_elementos;$i+=1)
	{
		$calificacion[$i]=0;
	}

	//Comparando elementos.
	for($i=0;$i<$cantidad_elementos;$i+=1)//Seleccionando elemento.
	{
		for($i2=0;$i2<$cantidad_elementos;$i2+=1)//Comparando elemento.
		{
			if($i!==$i2)//El elemento no se podrá comparar a si mismo
			{
				//Si el elemento seleccionado es mayor al elemento comparado.
				if($puntaje[$i]>$puntaje[$i2])
				{
					$calificacion[$i]+=1;
				}
				//Si el elemento seleccionado es igual al elemento comparado.
				$c1=($puntaje[$i]==$puntaje[$i2]);
				$c2=$i2>$i;
				if($c1 and $c2)
				{
					$calificacion[$i]+=1;
				}
			}
		}
	}


	//Organizando calificacion de menor a mayor
	for($i=0;$i<$cantidad_elementos;$i+=1)
	{
		$posicion_elemento=$calificacion[$i];
		//Relacionando la calificacion con la posicion
		$relacion_calif_pos[$posicion_elemento]=$i;
	}

	//Organizando de mayor a menor
	for($i=0;$i<$cantidad_elementos;$i+=1)
	{
		$posicion_x=$cantidad_elementos-1-$i;
		$orden_mayor_menor[$i]=$relacion_calif_pos[$posicion_x];
		$orden_mayor_menor_prev[$i]=$orden_mayor_menor[$i];
	}



	///////////////////////////////////////////////  INTEGRANDO DATOS

	$nombre[$cantidad_elementos]=$_POST["nombre"];
	$puntaje[$cantidad_elementos]=$_POST["puntaje"];

	$continuar=1;
	for($i=0;$i<$cantidad_elementos and $continuar;$i+=1)
	{
		$elemento_x=$orden_mayor_menor[$i];
		if($puntaje[$cantidad_elementos]>=$puntaje[$elemento_x])
		{	
			$orden_mayor_menor[$i]=$cantidad_elementos;
			for($i2=$i;$i2<$cantidad_elementos;$i2+=1)
			{
				$orden_mayor_menor[$i2+1]=$orden_mayor_menor_prev[$i2];
			}
			$continuar=0;//Detener el ciclo ford
		}
	}



	///////////////////////////////////////////////  SALIDA DE DATOS

	//relacionando puntajes con la salida
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$elemento_x=$orden_mayor_menor[$i];
		$nombre_salida[$i]=$nombre[$elemento_x];
		$puntaje_salida[$i]=$puntaje[$elemento_x];
	}

	echo "<br><br>";
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		echo "[score_$i2]: <br>";
		echo "$nombre_salida[$i] <br>";
		echo "$puntaje_salida[$i] <br><br>";
	}

	//Escribiendo en archivo ini
	$fichero = fopen($archivo_ini,"w");
	for($i=0;$i<$cantidad_elementos;$i++)
	{
		$i2=$i+1;
		fputs($fichero,"[score_$i2]\n");
		fputs($fichero,"nombre=".'"'."$nombre_salida[$i]".'"'."\n");
		fputs($fichero,"puntaje=$puntaje_salida[$i]\n\n");	
	}
	fclose($fichero);


}//FIN proteccion por clave

?>
