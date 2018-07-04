<?php
include("../config.php");
    include_once("../subValidation.php");
$table_name="tecnica";

$id = $_GET['id'];
$idAluno = $_GET['idAluno'];
$idAvaliacaoTecnica = $_GET['idAvaliacaoTecnica'];

$result = mysqli_query($mysqli, "DELETE FROM $table_name WHERE id=$id");

//header("Location:index.php?id=$idAvaliacaoTecnica&idAluno=$idAluno");
echo '<script> location.replace("index.php?id='.$idAvaliacaoTecnica.'&idAluno='.$idAluno.'"); </script>';
?>


