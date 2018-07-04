<html>
<head>
    <title>Adicionar nova técnica</title>
    <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
</head>

<body>
<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $table_name="tecnica";

if(isset($_POST['Submit'])) {	
    
        $idAluno = $_POST['idAluno'];
        $idAvaliacaoTecnica = mysqli_real_escape_string($mysqli, $_POST['idAvaliacaoTecnica']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$ordem = mysqli_real_escape_string($mysqli, $_POST['ordem']);
	$conceito = mysqli_real_escape_string($mysqli, $_POST['conceito']);
	$observacao = mysqli_real_escape_string($mysqli, $_POST['observacao']);
	$videouri = mysqli_real_escape_string($mysqli, $_POST['videouri']);
		
        if(empty($nome)) {
            echo "<font color='red'>Por favor preencha o nome.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
        }
        else if(empty($ordem)) {
            echo "<font color='red'>Por favor preencha a ordem.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
	} else { 
            $result = mysqli_query($mysqli, "INSERT INTO $table_name(nome,ordem,conceito,observacao,videoURI,idAvaliacaoTecnica) VALUES('$nome','$ordem','$conceito','$observacao','$videouri',$idAvaliacaoTecnica)");

            echo "<font color='green'>Adição realizada com sucesso.";
            echo "<br/><a href='index.php?id=$idAvaliacaoTecnica&idAluno=$idAluno'>Ver lista completa de técnicas da avaliação técnica</a>";
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
                    <a href="index.php?id=<?php echo $_GET['idAvaliacaoTecnica'];?>&idAluno=<?php echo $_GET['idAluno'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>

	<form action="add.php" method="post" name="form1">
		<table border="0">
			<tr> 
				<td>Nome</td>
				<td><input type="text" name="nome"></td>
			</tr>
			<tr> 
				<td>Ordem</td>
				<td><input type="text" name="ordem"></td>
			</tr>
			<tr> 
				<td>Conceito</td>
				<td><input type="text" name="conceito"></td>
			</tr>
			<tr> 
				<td>Observação</td>
				<td><input type="text" name="observacao"></td>
			</tr>
			<tr> 
				<td>VídeoURI</td>
				<td><input type="text" name="videouri"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="hidden" name="idAvaliacaoTecnica" value=<?php echo $_GET['idAvaliacaoTecnica'];?>></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $_GET['idAluno'];?>></td>
				<td><input type="submit" name="Submit" value="Adicionar"></td>
			</tr>
		</table>
	</form>
    <?php
}
    ?>
     </div>
</body>
</html>
