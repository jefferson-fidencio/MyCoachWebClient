<?php
    include_once("../config.php");
    include_once("../subValidation.php");
?>
<html>
<head>	
	<title>Treino Semanal</title>
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
            <br/>
        </table>
    
        <div style="height:90%;overflow:auto;">
    <table width='100%' border=0>
        <tr bgcolor='#CCCCCC'>
                <td style="width:150px">Dia</td>
                <td>Treino</td>
		<td style="width:50px">Editar</td>
        </tr>
        <?php 
        
        if(isset($_GET['idTreinoSemanal']))
        {
            $ImgMetragemSrc = $_GET['idTreinoSemanal'];
            $result = mysqli_query($mysqli, "SELECT * FROM treino_semanal WHERE id = $ImgMetragemSrc ORDER BY id DESC");
            while($res = mysqli_fetch_array($result)) { 
                $idAluno = $res['idAluno'];
            }
        }
        else{
            $idAluno = $_GET['id'];
        }
        $result = mysqli_query($mysqli, "SELECT * FROM treino_semanal WHERE idAluno = $idAluno ORDER BY id DESC");
        while($res = mysqli_fetch_array($result)) { 
            $ImgMetragemSrc = $res['id'];
        }
        
        $result = mysqli_query($mysqli, "SELECT * FROM treino WHERE idTreinoSemanal = $ImgMetragemSrc ORDER BY id ASC");
        while($res = mysqli_fetch_array($result)) { 		
                echo "<tr>";
                echo "<td>".$res['dia']."</td>";
                echo "<td>".$res['descricao']."</td>";
		echo "<td>";
                echo "<a href=\"edit.php?id=$res[id]\"><div class=\"btn btn_red\"><span id=\"btnClicavel\" class=\"icon\"></span><span></span></div></a>";
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
</style>
