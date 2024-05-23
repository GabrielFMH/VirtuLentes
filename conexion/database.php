<?php
function conectarse()
{
//Conectar con el servidor de base de datos
if (!($link = mysqli_connect("localhost","root", "Upt2024", "virtulentes")))
{
echo "Error conectando a la Base de Datos.";
exit();
}
return $link;}
?>