<?php
    include_once("config.php");
    
    if(isset($_COOKIE['login'])){
        $login_cookie = $_COOKIE['login'];
    }
    if(isset($login_cookie)){
    }else{
        header("Location: login.html");
    }
?>
<html>
<head>	
	<title>Home Swim Home</title>
        <!--<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />-->
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
<!-- Begin Page Content -->
<div id="container">
    <table border=0>
        <tr>
            <td>
                <div width='100%' border=0 class="btn7 btn_red"><span class="icon"></span><span></span></div>
            </td>
            <td>
                <a href="Aluno/add.php" style="font-size: 18px; text-decoration: none; display: inline;" >Adicionar novo aluno</a>
            </td>
            <td>
                <a href="logout.php" style="font-size: 18px; text-decoration: none; display: inline;" >Sair</a>
            </td>
        </tr>
        
        <br/>
    </table>
        <div style="height:90%;overflow:auto;">
	<table width='100%' border=0>
            <tr bgcolor='#CCCCCC'>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Senha</td>
                    <td style="width:60px">Foto</td>
                    <td style="width:50px">Editar</td>
                    <td style="width:60px">Deletar</td>
                    <td style="width:50px">Treino</td>
                    <td style="width:100px">Freq./Metrag.</td>
                    <td style="width:90px">Cond. Físico</td>
                    <td style="width:70px">Técnicas</td>
                    <td style="width:50px">Videos</td>
                    <td style="width:100px">Outros Vídeos</td>
            </tr>
            <?php 
            $result = mysqli_query($mysqli, "SELECT * FROM user WHERE categoria = 1 ORDER BY id DESC"); // using mysqli_query instead
            while($res = mysqli_fetch_array($result)) { 		
                    echo "<tr>";
                    echo "<td>".$res['nome']."</td>";
                    echo "<td>".$res['email']."</td>";
                    echo "<td>".$res['senha']."</td>";	
                    echo '<td><a target="_blank" href="'.substr($res['img'],3).'"><img src="'.substr($res['img'],3).'" alt="Não carregada" style="width:50px"></a></td>';
                    echo "<td>";
                    echo "<a href=\"Aluno/edit.php?id=$res[id]\"><div class=\"btn btn_red\"><span id=\"btnClicavel\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"Aluno/delete.php?id=$res[id]\" onClick=\"return confirm('Deseja realmente deletar o aluno?')\"><div class=\"btn2 btn_red\"><span id=\"btnClicavel2\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"Treino/index.php?id=$res[id]\"><div class=\"btn3 btn_red\"><span id=\"btnClicavel3\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"FrequenciaMetragem/index.php?id=$res[id]\"><div class=\"btn4 btn_red\"><span id=\"btnClicavel4\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"AvaliacaoCondFisico/index.php?id=$res[id]\"><div class=\"btn5 btn_red\"><span id=\"btnClicavel5\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"AvaliacaoTecnica/index.php?id=$res[id]\"><div class=\"btn6 btn_red\"><span id=\"btnClicavel6\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"Video/index.php?id=$res[id]\"><div class=\"btn8 btn_red\"><span id=\"btnClicavel3\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
                    echo "<td>";
                    echo "<a href=\"Outro_Video/index.php?id=$res[id]\"><div class=\"btn9 btn_red\"><span id=\"btnClicavel3\" class=\"icon\"></span><span></span></div></a>";
                    echo"</td>";
            }
            ?>
            </div>
	</table>
    </div>
</body>
</html>
</div>
<style>
    .btn span.icon {
    background: url(resources/ic_edit_24.png) no-repeat;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn2 span.icon {
    background: url(resources/ic_delete_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn3 span.icon {
    background: url(resources/ic_treino_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn4 span.icon {
    background: url(resources/ic_frequencias_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn5 span.icon {
    background: url(resources/ic_cond_fis_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn6 span.icon {
    background: url(resources/ic_aval_tecnica_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn7 span.icon {
    background: url(resources/ic_add_32.png) no-repeat;
    float: left;
    background-position: center;
    width: 38px;
    height: 30px;
}
    .btn8 span.icon {
    background: url(resources/ic_video_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
    .btn9 span.icon {
    background: url(resources/ic_youtube_24.png) no-repeat;;
    float: left;
    background-position: center;
    width: 100%;
    height: 24px;
}
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 60px;
}

img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
