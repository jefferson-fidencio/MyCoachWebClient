<?php
include("../config.php");
    include_once("../subValidation.php");

$id = $_GET['id'];
$idAluno = $_GET['idAluno'];

$result = mysqli_query($mysqli, "DELETE FROM avaliacao_cond_fisico WHERE id=$id");

    //header("Location:index.php?id=$idAluno");
    echo '<script> location.replace("index.php?id='.$idAluno.'"); </script>';
?>


