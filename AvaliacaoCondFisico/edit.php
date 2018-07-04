<?php
include_once("../config.php");
    include_once("../subValidation.php");
$table_name="avaliacao_cond_fisico";

if(isset($_POST['update']))
{	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$descricao = mysqli_real_escape_string($mysqli, $_POST['descricao']);
	$idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
	
        $result = mysqli_query($mysqli, "UPDATE $table_name SET nome='$nome',descricao='$descricao' WHERE id=$id");

        //header("Location: index.php?id=$idAluno");
        echo '<script> location.replace("index.php?id='.$idAluno.'"); </script>';
}
?>
<?php
$id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM $table_name WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['nome'];
	$descricao = $res['descricao'];
        $idAluno = $res['idAluno'];
}
?>
<html>
<head>	
	<title>Editar avaliação de condicionamento físico</title>
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
                    <a href="index.php?id=<?php echo $idAluno;?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Nome</td>
				<td><input type="text" name="nome" value="<?php echo $nome;?>"></td>
			</tr>
			<tr> 
				<td>Avaliação</td>
				<td><input type="text" name="descricao" value="<?php echo $descricao;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $idAluno;?>></td>
				<td><input type="submit" name="update" value="Alterar"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
