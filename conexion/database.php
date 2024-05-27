<?php

    function conectarse()
    {
        if(!($link = mysqli_connect("localhost","root","","db_virtulentes"))){
            echo "Error conectando a la abase de datos";
            exit();
        }
        return $link;
    }

?>