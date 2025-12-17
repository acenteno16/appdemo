<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $destination = '/home/files/folder_PCP0001/' 
. $filename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
        echo "Archivo subido exitosamente.";
    } else {
        echo "Error al subir el archivo.";
    }
}

?>