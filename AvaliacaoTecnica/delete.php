<?php
include("../config.php");
    include_once("../subValidation.php");
$table_name="avaliacao_tecnica";

$id = $_GET['id'];
$idAluno = $_GET['idAluno'];

$result = mysqli_query($mysqli, "DELETE FROM $table_name WHERE id=$id");

//header("Location:index.php?id=$idAluno");
echo '<script> location.replace("index.php?id='.$idAluno.'"); </script>';
?>


