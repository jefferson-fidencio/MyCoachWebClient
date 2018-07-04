<?php 
include_once("config.php");

    $login = $_POST['username'];
    $senha = $_POST['password']; 
    
    $verifica = mysqli_query($mysqli, "SELECT * FROM user WHERE email = '$login' AND senha = '$senha' AND categoria = 0") or die("erro ao selecionar");
      if (mysqli_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
        die();
      }else{
        setcookie("login",$login);
        header("Location:index.php");
      }
?>