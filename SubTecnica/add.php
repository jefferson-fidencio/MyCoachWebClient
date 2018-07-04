<html>
<head>
    <title>Adicionar nova sub-técnica</title>
    <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
</head>

<body>
<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $table_name="sub_tecnica";

if(isset($_POST['Submit'])) {	
    
        $idAluno = $_POST['idAluno'];
        $idTecnica = $_POST['idTecnica'];
        $idAvaliacaoTecnica = mysqli_real_escape_string($mysqli, $_POST['idAvaliacaoTecnica']);
        
        $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$execucao = mysqli_real_escape_string($mysqli, $_POST['execucao']);
		
        if(empty($nome)) {
            echo "<font color='red'>Por favor preencha o nome.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
        }
        else if(empty($execucao)) {
            echo "<font color='red'>Por favor preencha a execução.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
	}
        else { 
            $result = mysqli_query($mysqli, "INSERT INTO $table_name(nome,idExecucao,idTecnica) VALUES('$nome',$execucao,$idTecnica)");

            echo "<font color='green'>Adição realizada com sucesso.";
            echo "<br/><a href='index.php?id=$idTecnica&idAvaliacaoTecnica=$idAvaliacaoTecnica&idAluno=$idAluno'>Ver lista completa de sub-técnicas da técnica</a>";
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
                    <a href="index.php?id=<?php echo $_GET['idTecnica'];?>&idAvaliacaoTecnica=<?php echo $_GET['idAvaliacaoTecnica'];?>&idAluno=<?php echo $_GET['idAluno'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>
	<form action="add.php" method="post" name="form1">
		<table border="0">
			<tr> 
				<td width="100px">Nome</td>
				<td><input type="text" name="nome"></td>
			</tr>
			<tr> 
				<td width="100px">Execucao</td>
                                <td>
                                <?php
                                    $result = mysqli_query($mysqli, "SELECT * FROM execucao ORDER BY id DESC");
                                    while($res = mysqli_fetch_array($result)) { 
                                        echo '<input type="radio" name="execucao" value="'.$res['id'].'"> '.$res['nome'].'<br>';
                                    }
                                ?>
                                </td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="hidden" name="idTecnica" value=<?php echo $_GET['idTecnica'];?>></td>
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
