 <?php 
    setcookie("login" , '' , time()-50000, '/');
    header("Location: index.php");
    exit;
?>
<html>
<head>