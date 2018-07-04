<?php
include_once("../config.php");
    include_once("../subValidation.php");
$table_name="sub_tecnica";

if(isset($_POST['update']))
{	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$execucao = mysqli_real_escape_string($mysqli, $_POST['execucao']);
        
        $idAvaliacaoTecnica = mysqli_real_escape_string($mysqli, $_POST['idAvaliacaoTecnica']);
        $idTecnica = mysqli_real_escape_string($mysqli, $_POST['idTecnica']);
	$idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
	
        $result = mysqli_query($mysqli, "UPDATE $table_name SET nome='$nome',idExecucao=$execucao WHERE id=$id");

        //header("Location: index.php?id=$idTecnica&idAvaliacaoTecnica=$idAvaliacaoTecnica&idAluno=$idAluno");
        echo '<script> location.replace("index.php?id='.$idTecnica.'&idAvaliacaoTecnica='.$idAvaliacaoTecnica.'&idAluno='.$idAluno.'"); </script>';
}
?>
<?php
$id = $_GET['id'];
$idAluno = $_GET['idAluno'];
$idAvaliacaoTecnica = $_GET['idAvaliacaoTecnica'];
$result = mysqli_query($mysqli, "SELECT * FROM $table_name WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['nome'];
        $execucao = $res['idExecucao'];
        $idTecnica = $res['idTecnica'];
}
?>
<html>
<head>	
    <title>Editar sub-técnica</title>
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
                    <a href="index.php?id=<?php echo $_GET['idTecnica'];?>&idAvaliacaoTecnica=<?php echo $_GET['idAvaliacaoTecnica'];?>&idAluno=<?php echo $_GET['idAluno'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td width="100px">Nome</td>
				<td><input type="text" name="nome" value="<?php echo $nome;?>"></td>
			</tr>
			<tr> 
				<td width="100px">Execucao</td>
                                <td>
                                <?php
                                    $result = mysqli_query($mysqli, "SELECT * FROM execucao ORDER BY id DESC");
                                    while($res = mysqli_fetch_array($result)) { 
                                        if ($res['id'] == $execucao)
                                        {
                                            $checked = ' checked="checked"';
                                        }
                                        else $checked = '';
                                        echo '<input type="radio" name="execucao" value="'.$res['id'].'"'.$checked.'> '.$res['nome'].'<br>';
                                    }
                                ?>
                                </td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $idAluno;?>></td>
				<td><input type="hidden" name="idTecnica" value=<?php echo $_GET['idTecnica'];?>></td>
				<td><input type="hidden" name="idAvaliacaoTecnica" value=<?php echo $_GET['idAvaliacaoTecnica'];?>></td>
				<td><input type="submit" name="update" value="Alterar"></td>
			</tr>
		</table>
	</form>
        </div>
</body>
</html>
