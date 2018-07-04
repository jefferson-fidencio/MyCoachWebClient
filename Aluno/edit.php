<?php
// including the database connection file
include_once("../config.php");
    include_once("../subValidation.php");

if(isset($_POST['update']))
{	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
	$Email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$Senha = mysqli_real_escape_string($mysqli, $_POST['senha']);
        $alunoImgTmp = basename($_FILES["fileToUpload"]["name"]);	
	
	// checking empty fields
	if(empty($nome) || empty($Email) || empty($Senha)) {	
			
		if(empty($nome)) {
			echo "<font color='red'>Por favor preencha o nome do aluno.</font><br/>";
		}
		
		if(empty($Email)) {
			echo "<font color='red'>Por favor preencha o email do aluno.</font><br/>";
		}
		
		if(empty($Senha)) {
			echo "<font color='red'>Por favor preencha a senha do aluno.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE aluno SET nome='$nome',email='$Email',senha='$Senha' WHERE id=$id");
		
                //cria imagem do aluno, se foi escolhida
                if ($alunoImgTmp != "")
                {
                    $tmp = explode('.',$alunoImgTmp);
                    $extensao = end($tmp);            
                    $novoNomeImgAluno = "../UploadedImages/Aluno/AlunoID".$id."Img.".$extensao;
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$novoNomeImgAluno);
                    
                    // atualiza no bd os nomes dos arquivos
                    $result = mysqli_query($mysqli, "UPDATE aluno SET alunoImg='$novoNomeImgAluno' WHERE id=$id");
                }
                
		//redirectig to the display pEmail. In our case, it is index.php
		//header("Location: ../index.php");
                echo '<script> location.replace("../index.php"); </script>';
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM aluno WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['nome'];
	$Email = $res['email'];
	$Senha = $res['senha'];
}
?>
<html>
<head>	
	<title>Editar dados do aluno</title>
        <link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
	
	<form name="form1" method="post" action="edit.php" enctype="multipart/form-data">
		<table border="0">
			<tr> 
				<td>Nome</td>
				<td><input type="text" name="nome" value="<?php echo $nome;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $Email;?>"></td>
			</tr>
			<tr> 
				<td>Senha</td>
				<td><input type="text" name="senha" value="<?php echo $Senha;?>"></td>
			</tr>
                        <tr>
				<td>Foto</td>
                                <td><input type="file" name="fileToUpload" id="fileToUpload" style="width: 380px"></td>
                        </tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Alterar"></td>
			</tr>
		</table>
	</form>
    </div>
</body>
</html>
