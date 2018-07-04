<?php
include_once("../config.php");
    include_once("../subValidation.php");
$table_name="tecnica";

if(isset($_POST['update']))
{	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$ordem = mysqli_real_escape_string($mysqli, $_POST['ordem']);
	$conceito = mysqli_real_escape_string($mysqli, $_POST['conceito']);
	$observacao = mysqli_real_escape_string($mysqli, $_POST['observacao']);
	$videouri = mysqli_real_escape_string($mysqli, $_POST['videouri']);
        $idAvaliacaoTecnica = mysqli_real_escape_string($mysqli, $_POST['idAvaliacaoTecnica']);
	$idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
	
        $result = mysqli_query($mysqli, "UPDATE $table_name SET nome='$nome',ordem='$ordem',conceito='$conceito',observacao='$observacao',videoURI='$videouri' WHERE id=$id");

        //header("Location: index.php?id=$idAvaliacaoTecnica&idAluno=$idAluno");
        echo '<script> location.replace("index.php?id='.$idAvaliacaoTecnica.'&idAluno='.$idAluno.'"); </script>';
}
?>
<?php
$id = $_GET['id'];
$idAluno = $_GET['idAluno'];
$result = mysqli_query($mysqli, "SELECT * FROM $table_name WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['nome'];
        $ordem = $res['ordem'];
        $conceito = $res['conceito'];
        $observacao = $res['observacao'];
        $videouri = $res['videoURI'];
        $idAvaliacaoTecnica = $res['idAvaliacaoTecnica'];
}
?>
<html>
<head>	
    <title>Editar técnica</title>
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
                    <a href="index.php?id=<?php echo $_GET['idAvaliacaoTecnica'];?>&idAluno=<?php echo $_GET['idAluno'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
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
				<td>Ordem</td>
				<td><input type="text" name="ordem" value="<?php echo $ordem;?>"></td>
			</tr>
			<tr> 
				<td>Conceito</td>
				<td><input type="text" name="conceito" value="<?php echo $conceito;?>"></td>
			</tr>
			<tr> 
				<td>Observação</td>
				<td><input type="text" name="observacao" value="<?php echo $observacao;?>"></td>
			</tr>
			<tr> 
				<td>VídeoURI</td>
				<td><input type="text" name="videouri" value="<?php echo $videouri;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $idAluno;?>></td>
				<td><input type="hidden" name="idAvaliacaoTecnica" value=<?php echo $_GET['idAvaliacaoTecnica'];?>></td>
				<td><input type="submit" name="update" value="Alterar"></td>
			</tr>
		</table>
	</form>
    </div>
</body>
</html>
