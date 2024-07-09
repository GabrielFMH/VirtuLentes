<?php
function conectarse()
{
//Conectar con el servidor de base de datos
if (!($link = mysqli_connect("localhost","root", "", "virtulentes")))
{
echo "Error conectando a la Base de Datos.";
exit();
}
return $link;}
?>