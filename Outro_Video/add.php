<html>
<head>
    <title>Adicionar novo vídeo</title>
    <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
</head>

<body>
<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $table_name="outro_video";

if(isset($_POST['Submit'])) {	
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$video = mysqli_real_escape_string($mysqli, $_POST['video']);
        $idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
		
	if(empty($nome) || empty($video)) {
				
		if(empty($nome)) {
			echo "<font color='red'>Por favor preencha o nome.</font><br/>";
		}
                if(empty($video)) {
			echo "<font color='red'>Por favor preencha o link do vídeo.</font><br/>";
		}
		echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
	} else { 
		$result = mysqli_query($mysqli, "INSERT INTO $table_name(nome,video,idAluno) VALUES('$nome','$video',$idAluno)");
		
		echo "<font color='green'>Adição realizada com sucesso.";
		echo "<br/><a href='index.php?id=$idAluno'>Ver lista completa de outros vídeos do aluno</a>";
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
				<td>Vídeo</td>
				<td><input type="text" name="video"></td>
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
