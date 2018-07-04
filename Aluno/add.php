<?php
    //including the database connection file
    include_once("../config.php");
    
    $idCoach = mysqli_real_escape_string($mysqli, $_POST['idCoach']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['name']);
    $Email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $Senha = mysqli_real_escape_string($mysqli, $_POST['password']);
    $modalidade = mysqli_real_escape_string($mysqli, $_POST['modalidade']);
    //$alunoImgTmp = basename($_FILES["fileToUpload"]["name"]);
    
    //insert data to database	
    $result = mysqli_query($mysqli, "INSERT INTO user(nome,email,senha) VALUES('$nome','$Email','$Senha')");
    $idAluno = $mysqli->insert_id;

    // relaciona aluno com coach
    $result = mysqli_query($mysqli, "INSERT INTO user_user_modalidade(idCoach,idAluno,idModalidade) VALUES('$idCoach','$idAluno','$modalidade')");
    $idAluno = $mysqli->insert_id;

    //cria imagem do aluno, se foi escolhida
    /*if ($alunoImgTmp != "")
    {
        $tmp = explode('.',$alunoImgTmp);
        $extensao = end($tmp);            
        $novoNomeImgAluno = "../UploadedImages/Aluno/AlunoID".$idAluno."Img.".$extensao;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$novoNomeImgAluno);
        
        // atualiza no bd os nomes dos arquivos
        $result = mysqli_query($mysqli, "UPDATE aluno SET alunoImg='$novoNomeImgAluno' WHERE id=$idAluno");
    }*/
    
    //cria treino semanal vazio do aluno
    mysqli_query($mysqli, "INSERT INTO treino_semanal(idAluno) VALUES($idAluno)");
    //cria treino vazio de cada dia da semana
    $ImgMetragemSrc = $mysqli->insert_id;
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Segunda-Feira','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Terça-Feira','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Quarta-Feira','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Quinta-Feira','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Sexta-Feira','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Sábado','',$ImgMetragemSrc)");
    mysqli_query($mysqli, "INSERT INTO treino(dia,descricao,idTreinoSemanal) VALUES('Domingo','',$ImgMetragemSrc)");

    //display success message
    echo "Aluno adicionado com sucesso.";
?>