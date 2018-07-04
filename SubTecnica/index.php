<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $table_name = "sub_tecnica";
    $idTecnica = $_GET['id'];
    $idAvaliacaoTecnica = $_GET['idAvaliacaoTecnica'];
    $idAluno = $_GET['idAluno'];
?>
<html>
<head>	
	<title>Sub-Técnicas</title>
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
                    <a href="../Tecnica/index.php?id=<?php echo $idAvaliacaoTecnica; ?>&idAluno=<?php echo $idAluno; ?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="btn_add"></div>
                </td>
                <td>
                    <a href="add.php?idTecnica=<?php echo $idTecnica; ?>&idAvaliacaoTecnica=<?php echo $idAvaliacaoTecnica; ?>&idAluno=<?php echo $idAluno; ?>" style="font-size: 18px; text-decoration: none; display: inline;" >Adicionar nova sub-técnica</a>
                </td>
            </tr>
            <br/>
        </table>
        
        <div style="height:90%;overflow:auto;">
	<table width='100%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Nome</td>
		<td>Execucao</td>
		<td style="width:50px">Editar</td>
		<td style="width:60px">Deletar</td>
	</tr>
	<?php 
        $result = mysqli_query($mysqli, "SELECT * FROM $table_name WHERE idTecnica = $idTecnica ORDER BY id DESC"); // using mysqli_query instead
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['nome']."</td>";
                $result1 = mysqli_query($mysqli, "SELECT * FROM execucao WHERE id =".$res['idExecucao']." ORDER BY id DESC"); // using mysqli_query instead
                while($res1 = mysqli_fetch_array($result1)) { 
                    echo "<td>".$res1['nome']."</td>";
                }
                echo "<td>";
                echo "<a href=\"edit.php?id=$res[id]&idTecnica=$idTecnica&idAvaliacaoTecnica=$idAvaliacaoTecnica&idAluno=$idAluno\"><div class=\"btn btn_red\"><span id=\"btnClicavel\" class=\"icon\"></span><span></span></div></a>";
                echo"</td>";
                echo "<td>";
                echo "<a href=\"delete.php?id=$res[id]&idTecnica=$idTecnica&idAvaliacaoTecnica=$idAvaliacaoTecnica&idAluno=$idAluno\" onClick=\"return confirm('Deseja realmente deletar a sub-técnica?')\"><div class=\"btn2 btn_red\"><span id=\"btnClicavel2\" class=\"icon\"></span><span></span></div></a>";
                echo"</td>";
	}
	?>
	</table>
        </div>
    </div>
</body>
</html>
<style>
    .btn span.icon {
    background: url(../resources/ic_edit_24.png) no-repeat;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn2 span.icon {
    background: url(../resources/ic_delete_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
</style>
