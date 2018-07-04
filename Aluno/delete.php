<?php
//including the database connection file
include("../config.php");
    include_once("../subValidation.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM aluno WHERE id=$id");

    //redirecting to the display pEmail (index.php in our case)
    //header("Location:../index.php");
    echo '<script> location.replace("../index.php"); </script>';
?>

