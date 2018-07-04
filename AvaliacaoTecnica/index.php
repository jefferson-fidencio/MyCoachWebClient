<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $idAluno = $_GET['id'];
    $table_name = "avaliacao_tecnica";
?>
<html>
<head>	
	<title>Avaliações técnicas</title>
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
                    <a href="../index.php" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="btn_add"></div>
                </td>
                <td>
                    <a href="add.php?idAluno=<?php echo $idAluno; ?>" style="font-size: 18px; text-decoration: none; display: inline;" >Adicionar nova avaliação técnica</a>
                </td>
            </tr>
            <br/>
        </table>

        <div style="height:90%;overflow:auto;">
	<table width='100%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Nome</td>
		<td style="width:70px">Tecnicas</td>
		<td style="width:50px">Editar</td>
		<td style="width:60px">Deletar</td>
	</tr>
	<?php 
        $result = mysqli_query($mysqli, "SELECT * FROM $table_name WHERE idAluno = $idAluno ORDER BY id DESC"); // using mysqli_query instead
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['nome']."</td>";
                echo "<td>";
                echo "<a href=\"../Tecnica/index.php?id=$res[id]&idAluno=$idAluno\"><div class=\"btn3 btn_red\"><span id=\"btnClicavel\" class=\"icon\"></span><span></span></div></a>";
                echo"</td>";
                echo "<td>";
                echo "<a href=\"edit.php?id=$res[id]\"><div class=\"btn btn_red\"><span id=\"btnClicavel\" class=\"icon\"></span><span></span></div></a>";
                echo"</td>";
                echo "<td>";
                echo "<a href=\"delete.php?id=$res[id]&idAluno=$idAluno\" onClick=\"return confirm('Deseja realmente deletar a avaliação?')\"><div class=\"btn2 btn_red\"><span id=\"btnClicavel2\" class=\"icon\"></span><span></span></div></a>";
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
    .btn3 span.icon {
    background: url(../resources/ic_search_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
</style>

