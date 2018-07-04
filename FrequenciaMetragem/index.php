<?php
    include_once("../config.php");
    include_once("../subValidation.php");
    $idAluno = $_GET['id'];
?>
<html>
<head>	
	<title>Frequências e metragens</title>
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
                    <a href="add.php?id=<?php echo $idAluno; ?>" style="font-size: 18px; text-decoration: none; display: inline;" >Adicionar nova frequência e metragem</a>
                </td>
            </tr>
            <br/>
        </table>

        <div style="height:85%;overflow:auto;">
	<table width='100%' border=0 table-layout=fixed >

	<tr bgcolor='#CCCCCC'>
		<td style="width:250px">Nome</td>
		<td>Frequência</td>
		<td>Metragem</td>
		<td style="width:60px">Deletar</td>
	</tr>
	<?php 
        $result = mysqli_query($mysqli, "SELECT * FROM frequencia_metragem WHERE idAluno = $idAluno ORDER BY id DESC"); // using mysqli_query instead
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['nome']."</td>";
                echo '<td><a target="_blank" href="'.$res['frequenciaImg'].'"><img src="'.$res['frequenciaImg'].'" alt="Não carregada" style="width:150px"></a></td>';
                echo '<td><a target="_blank" href="'.$res['metragemImg'].'"><img src="'.$res['metragemImg'].'" alt="Não carregada" style="width:150px"></a></td>';
                echo "<td>";
                echo "<a href=\"delete.php?id=$res[id]&idAluno=$idAluno\" onClick=\"return confirm('Deseja realmente deletar as frequências e metragens do aluno?')\"><div class=\"btn2 btn_red\"><span id=\"btnClicavel2\" class=\"icon\"></span><span></span></div></a>";
                echo"</td>";
	}
	?>
	</table>
    </div>
    </div>
</body>
</html>
<style>
    .btn7 span.icon {
    background: url(../resources/ic_frequencias_24.png) no-repeat;
    float: left;
    background-position: center;
    width: 35px;
    height: 24px;
}
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
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
}

img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
