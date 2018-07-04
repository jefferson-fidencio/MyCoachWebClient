<html>
<head>
    <title>Adicionar nova avaliação técnica</title>
    <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
</head>

<body>
<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $table_name="avaliacao_tecnica";

if(isset($_POST['Submit'])) {	
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
        $idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
		
	if(empty($nome)) {
				
		if(empty($nome)) {
			echo "<font color='red'>Por favor preencha o nome.</font><br/>";
		}		
		echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
	} else { 
		$result = mysqli_query($mysqli, "INSERT INTO $table_name(nome,idAluno) VALUES('$nome',$idAluno)");
		
		echo "<font color='green'>Adição realizada com sucesso.";
		echo "<br/><a href='index.php?id=$idAluno'>Ver lista completa de avaliações do aluno</a>";
	}
}
else {
?>
        <div id="container">
        <table border=0>
            <tr>
                <td>
                    <div id="btn_voltar"></div>
                </td>
                <td>
                    <a href="index.php?id=<?php echo $_GET['idAluno'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>

	<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>Nome</td>
				<td><input type="text" name="nome"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $_GET['idAluno'];?>></td>
				<td><input type="submit" name="Submit" value="Adicionar"></td>
			</tr>
		</table>
	</form>
    <?php
}
    ?>
</body>
</html>
