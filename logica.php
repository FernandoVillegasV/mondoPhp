<?php

date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");  

require 'vendor/autoload.php'; // Cargar Composer

    $cliente = new MongoDB\Client("mongodb+srv://fernandovillegas180_db_user:xKMA4LxVGyMUxjHW@cluster1.dxvscli.mongodb.net/?appName=Cluster1");
    $db = $cliente->aprendices;
    $coleccion = $db->gustos;
    $resultado = $coleccion->insertOne([
        "apellidos" => $_POST["apellidos"],
        "nombres" => $_POST["nombres"],
        "color" => $_POST["color"],
        "comida" => $_POST["comida"],
        "pelicula" => $_POST["pelicula"],
        "registro" => $hoy
    ]);
    echo "<center><h3 style='border:1px solid green;background-color:rgb(64,145,108);color:white;padding:1%;'>Documento insertado con ID: " . $resultado->getInsertedId() . "</h3></center>";

    $cursor = $coleccion->find();
    echo "<table>";
    echo "<tr><th>CODIGO</th><th>NOMBRE</th><th>EDAD</th><th>CORREO</th></tr>";
    foreach ($cursor as $doc) {
        echo "<tr>";
        echo "<td>". $doc["_id"]. "</td>";
        echo "<td>". $doc["apellidos"]. "</td>";
        echo "<td>". $doc["nombres"]. "</td>";
        echo "<td>". $doc["color"]. "</td>";
        echo "<td>". $doc["comida"]. "</td>";
        echo "<td>". $doc["pelicula"]. "</td>";
        echo "<td>". $doc["registro"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
include "index.html";

?>