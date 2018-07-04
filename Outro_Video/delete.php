<?php
include("../config.php");
    include_once("../subValidation.php");
$table_name="outro_video";

$id = $_GET['id'];
$idAluno = $_GET['idAluno'];

$result = mysqli_query($mysqli, "DELETE FROM $table_name WHERE id=$id");

//header("Location:index.php?id=$idAluno");
echo '<script> location.replace("index.php?id='.$idAluno.'"); </script>';
?>


