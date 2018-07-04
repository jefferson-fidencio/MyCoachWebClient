<?php
// including the database connection file
include_once("../config.php");
    include_once("../subValidation.php");

if(isset($_POST['update']))
{	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['dia']);
	$descricao = mysqli_real_escape_string($mysqli, $_POST['descricao']);
	$ImgMetragemSrc = mysqli_real_escape_string($mysqli, $_POST['idTreinoSemanal']);
	
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE treino SET descricao='$descricao' WHERE id=$id");

        //redirectig to the display pEmail. In our case, it is index.php
        //header("Location: index.php?idTreinoSemanal=$ImgMetragemSrc");
        echo '<script> location.replace("index.php?idTreinoSemanal='.$ImgMetragemSrc.'"); </script>';
}
?>
<?php
$id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM treino WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['dia'];
	$descricao = $res['descricao'];
        $ImgMetragemSrc = $res['idTreinoSemanal'];
}
?>
<html>
<head>	
	<title>Editar treino</title>
        <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
</head>

<body>
    <div id="container">
        <table border=0>
            <tr>
                <td>
                    <div id="btn_voltar"></div>
                </td>
                <td>
                    <a href="index.php?idTreinoSemanal=<?php echo $ImgMetragemSrc;?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Dia</td>
				<td><?php echo $nome;?></td>
			</tr>
			<tr> 
				<td>Treino</td>
                                <td><textarea name="descricao" cols="40" rows="5"><?php echo $descricao;?></textarea></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="hidden" name="idTreinoSemanal" value=<?php echo $ImgMetragemSrc;?>></td>
				<td><input type="submit" name="update" value="Alterar"></td>
			</tr>
		</table>
	</form>
    </div>
</body>
</html>
