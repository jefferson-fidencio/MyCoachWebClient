<html>
<head>
    <title>Adicionar nova frequência e metragem</title>
    <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
    
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $("#dialogFrequencia").dialog({
            autoOpen: false,
            width: 450,
            height: 250,
            modal: true,
        });
        $("#buttonFrequencia").on("click", function() {
            $("#dialogFrequencia")
                .dialog("open");
        });
    });
    
    $(function() {
        $("#dialogMetragem").dialog({
            autoOpen: false,
            width: 450,
            height: 250,
            modal: true,
        });
        $("#buttonMetragem").on("click", function() {
            $("#dialogMetragem")
                .dialog("open");
        });
    });
});
</script>

</head>
<body>
<?php
include_once("../config.php");
    include_once("../subValidation.php");

if(isset($_POST['Submit'])) {	
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$ImgFrequenciaSrc = mysqli_real_escape_string($mysqli, $_POST['ImgFrequenciaSrc']);
	$ImgMetragemSrc = mysqli_real_escape_string($mysqli, $_POST['ImgMetragemSrc']);
        $idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
		
	// checking empty fields
	if(empty($nome)) {
				
		if(empty($nome)) {
			echo "<font color='red'>Por favor preencha o nome da frequência e metragem.</font><br/>";
		}		
		
		//link to the previous pEmail
		echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
	} else { 
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO frequencia_metragem(nome,frequenciaImg,metragemImg,idAluno) VALUES('$nome','$ImgFrequenciaSrc','$ImgMetragemSrc',$idAluno)");
		$idFrequenciaMetragem = $mysqli->insert_id;
                  
                //se deu certo, renomeia os nomes das imagens carregadas temporariamente para o nome da metragem e frequencia do aluno
                $novoNomeImgMetragemSrc = "";
                $novoNomeImgFrequenciaSrc = "";
                if ($ImgMetragemSrc != "")
                {
                    $tmp = explode('.', $ImgMetragemSrc);
                    $extensaoMetragem = end($tmp);            
                    $novoNomeImgMetragemSrc = "../UploadedImages/Metragens/AlunoID".$idAluno."FrequenciaMetragemID".$idFrequenciaMetragem.".".$extensaoMetragem;
                    rename($ImgMetragemSrc, $novoNomeImgMetragemSrc);
                }
                if ($ImgFrequenciaSrc != "")
                {
                    $tmp = explode('.', $ImgFrequenciaSrc);
                    $extensaoFrequencia = end($tmp);
                    $novoNomeImgFrequenciaSrc = "../UploadedImages/Frequencias/AlunoID".$idAluno."FrequenciaMetragemID".$idFrequenciaMetragem.".".$extensaoFrequencia;
                    rename($ImgFrequenciaSrc, $novoNomeImgFrequenciaSrc);
                }
                
                // atualiza no bd os nomes dos arquivos
                $result = mysqli_query($mysqli, "UPDATE frequencia_metragem SET frequenciaImg='$novoNomeImgFrequenciaSrc',metragemImg='$novoNomeImgMetragemSrc' WHERE id=$idFrequenciaMetragem");
                
		//display success messEmail
		echo "<font color='green'>Frequência e metragem adicionada com sucesso.";
		echo "<br/><a href='index.php?id=$idAluno'>Ver lista completa de frequências e metragens do aluno</a>";
	}
}
else if (isset($_POST['uploadFrequencia']))
{
    $idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $ImgMetragemSrc = $_POST['ImgMetragemSrc'];
    $target_dir = "../UploadedImages/Frequencias/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<font color='red'>Por favor selecione um arquivo de imagem.</font><br/>";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //TODO substituir
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<font color='red'>Por favor selecione um arquivo menor que 5 megabytes.</font><br/>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        echo "<font color='red'>Por favor selecione um arquivo de imagem no formato JPG, JPEG ou PNG.</font><br/>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<font color='red'>Não foi possível carregar a imagem.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //header("Location: add.php?id=$idAluno&ImgFrequenciaSrc=$target_file&ImgMetragemSrc=$ImgMetragemSrc&nome=$nome");
            echo '<script> location.replace("add.php?id='.$idAluno.'&ImgFrequenciaSrc='.$target_file.'&ImgMetragemSrc='.$ImgMetragemSrc.'&nome='.$nome.'"); </script>';
        } else {
            echo "<font color='red'>Não foi possível carregar a imagem.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
        }
    }
}
else if (isset($_POST['uploadMetragem']))
{
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $idAluno = mysqli_real_escape_string($mysqli, $_POST['idAluno']);
    $ImgFrequenciaSrc = $_POST['ImgFrequenciaSrc'];
    $target_dir = "../UploadedImages/Metragens/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<font color='red'>Por favor selecione um arquivo de imagem.</font><br/>";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //TODO substituir
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<font color='red'>Por favor selecione um arquivo menor que 5 megabytes.</font><br/>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        echo "<font color='red'>Por favor selecione um arquivo de imagem no formato JPG, JPEG ou PNG.</font><br/>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<font color='red'>Não foi possível carregar a imagem.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            //header("Location: add.php?id=$idAluno&ImgMetragemSrc=$target_file&ImgFrequenciaSrc=$ImgFrequenciaSrc&nome=$nome");
            echo '<script> location.replace("add.php?id='.$idAluno.'&ImgMetragemSrc='.$target_file.'&ImgFrequenciaSrc='.$ImgFrequenciaSrc.'&nome='.$nome.'"); </script>';
        } else {
            echo "<font color='red'>Não foi possível carregar a imagem.</font><br/>";
            echo "<br/><a href='javascript:self.history.back();'>Voltar</a>";
        }
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
                    <a href="index.php?id=<?php echo $_GET['id'];?>" style="font-size: 18px; text-decoration: none; display: inline;" >Voltar</a>
                </td>
            </tr>
            <br/>
        </table>

        <div style="height:90%;overflow:auto;">
	<form action="add.php" method="post" name="form1">
		<table width="100%" border="0">
			<tr> 
				<td>Nome</td>
                                <td><input type="text" name="nome" value="<?php if (isset($nome)) {echo $nome;}?>"></td>
			</tr>
			<tr> 
				<td>ImgFrequenciaSrc</td>
				<td>
                                    <?php 
                                        if (isset($_GET['ImgFrequenciaSrc'])){
                                             echo '<img src="' . $_GET['ImgFrequenciaSrc'] . '" />';
                                        }
                                        else{
                                            echo 'Imagem não selecionada';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn3 btn_red"><span id="buttonFrequencia" class="icon"></span><span></span></div>
                                </td>
			</tr>
			<tr> 
				<td>ImgMetragemSrc</td>
				<td>
                                    <?php 
                                        if (isset($_GET['ImgMetragemSrc'])){
                                             echo '<img src="' . $_GET['ImgMetragemSrc'] . '" />';
                                        }
                                        else{
                                            echo 'Imagem não selecionada';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn3 btn_red"><span id="buttonMetragem" class="icon"></span><span></span></div>
                                </td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="hidden" name="idAluno" value=<?php echo $_GET['id'];?>></td>
                                <td><input type="hidden" name="ImgFrequenciaSrc" value=<?php if (isset($_GET['ImgFrequenciaSrc'])){ echo $_GET['ImgFrequenciaSrc']; }?>></td>
                                <td><input type="hidden" name="ImgMetragemSrc" value=<?php if (isset($_GET['ImgMetragemSrc'])){ echo $_GET['ImgMetragemSrc']; }?>></td>
				<td><input type="submit" name="Submit" value="Adicionar"></td>
			</tr>
		</table>
	</form>
        </div>
    <?php
}
    ?>
    </div>   
    
    <div id="dialogFrequencia" title="Carregar imagem">
        <form action="add.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Selecione a imagem a carregar:</td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload" style="width: 380px">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        if (isset($_GET['ImgMetragemSrc'])){
                            if ($_GET['ImgMetragemSrc'] != ""){
                                echo '<input type="hidden" name="ImgMetragemSrc" value='.$_GET['ImgMetragemSrc'].'>';
                            }
                        }?>
                        <input type="hidden" name="idAluno" value=<?php echo $_GET['id'];?>>
                        <input type="submit" value="Salvar" name="uploadFrequencia">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <div id="dialogMetragem" title="Carregar imagem">
        <form action="add.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Selecione a imagem a carregar:</td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload" style="width: 380px">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if (isset($_GET['ImgFrequenciaSrc'])){
                            if ($_GET['ImgFrequenciaSrc'] != ""){
                                echo '<input type="hidden" name="ImgFrequenciaSrc" value='.$_GET['ImgFrequenciaSrc'].'>';
                            }
                        }?>
                        <input type="hidden" name="idAluno" value=<?php echo $_GET['id'];?>>
                        <input type="submit" value="Salvar" name="uploadMetragem">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>
<style>
    .btn3 span.icon {
    background: url(../resources/ic_upload_32.png) no-repeat;
    float: right;
    background-position: center;
    width: 32px;
    height: 32px;
}
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 250px;
}

img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
