<?php

$databaseHost = 'localhost';
$databaseNome = 'hshpe859_hshDB';
$databaseUsernome = 'hshpe859_jeff';
$databasePassword = 'admin12345';

$mysqli = mysqli_connect($databaseHost, $databaseUsernome, $databasePassword, $databaseNome);
mysqli_query($mysqli, "SET NAMES 'utf8'"); 
mysqli_query($mysqli, 'SET character_set_connection=utf8'); 
mysqli_query($mysqli, 'SET character_set_client=utf8'); 
mysqli_query($mysqli, 'SET character_set_results=utf8'); 


?>
