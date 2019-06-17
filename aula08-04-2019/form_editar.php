<?php session_start(); 
if(!isset($_SESSION['login']) == true and !isset($_SESSION['senha'])==true)
{
	unset ($_SESSION['login']);
  	unset ($_SESSION['senha']);
  	header('location:index.html');
}	
?> 

<?php
	if(isset($_GET['matricula']))
	{
		$matricula = $_GET['matricula'];
		$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw',  array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$sql = "SELECT * FROM tabela_professor WHERE matricula=?";
		$busca = $conexao->prepare($sql);
		$busca->bindParam(1,$matricula);
		$busca->execute();
		
		$registro = $busca->fetch(PDO::FETCH_ASSOC);
		
		
	}
?>

<?php
	if(isset($_POST['atualizar']))
	{
		$matricula = $_POST['matricula'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$data_nascimento = $_POST['data_nascimento'];
		$valor = $_POST['valor'];
		$arquivo = $_FILES['arquivo'];
		
		$nome_arquivo = $_FILES['arquivo']['name'];
		$extensao = explode(".", $nome_arquivo);

		$nome_final = md5(time()) . "." . $extensao[1];
		echo $nome_final;
		$pasta = "fotos/";
		
		$cmd_atualizar = "UPDATE tabela_professor SET nome = ?, email = ?, telefone = ?, celular = ?, data_nascimento = ?, valor = ?, foto = ? WHERE matricula = ?";
		
		$stmt = $conexao->prepare($cmd_atualizar);
		$stmt->bindParam(1, $nome);
		$stmt->bindParam(2, $email);
		$stmt->bindParam(3, $telefone);
		$stmt->bindParam(4, $celular);
		$stmt->bindParam(5, $data_nascimento);
		$stmt->bindParam(6, $valor);
		$stmt->bindParam(7, $nome_final);
		$stmt->bindParam(8, $matricula);
		
		$resultado = $stmt->execute();
		
		if ($resultado and move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
		{
			echo "<script>alert('Atualizado com sucesso!');</script>";
		}
		else
		{
			echo var_dump($stmt->errorInfo());
		}
		
	}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulário para editar professor - Usuário:<?php echo $_SESSION['usuario'];?></title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/estilo_do_menu.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    	<img src="imagens/logo_etec_2019.png">
</header>
    
    <nav>
    	<ul>
        	<li><a href="index.php">Home</a></li>
            <li><a href="form_cadastro.php">Cadastrar Aluno</a></li>
            <li><a href="form_busca_aluno.php">Buscar Alunos</a></li>
            <li><a href="form_exibir_aluno.php">Exibir Alunos</a></li>
            <li><a href="form_cadastro_professor.php">Cadastrar Professor</a></li>
            <li><a href="form_busca.php">Buscar Professores</a></li>
            <li><a href="form_exibir_professores.php">Exibir Professores</a></li>
            <li><a href="#">Usuário logado:  <?php echo $_SESSION['usuario'];?></a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
    
    <main>

        <form action="#" method="post" enctype="multipart/form-data">
                <p><label>Matrícula:</label>
                <input type="number" size="5" name="matricula" value="<?php echo $registro['matricula']?>" required></p>
                
                <p><label>Nome do Professor(a):</label>
                <input type="text" name="nome" size="50" value="<?php echo $registro['nome']?>" required></p>
                
                <p><label>E-mail:</label>
                <input type="text" name="email" size="50" value="<?php echo $registro['email']?>" required></p>
                
                <p><label>Telefone:</label>
                <input type="text" name="telefone" size="15" value="<?php echo $registro['telefone']?>" required></p>
                
                <p><label>Celular:</label>
                <input type="text" name="celular" value="<?php echo $registro['celular']?>" size="15"></p>
              
                <p><label>Data de Nascimento:</label>
                <input type="date" name="data_nascimento" value="<?php echo $registro['data_nascimento']?>"></p>
                
                <p><label>Valor:</label>
                <input type="text" name="valor" value="<?php echo $registro['valor']?>"></p>
                
                <p><label>Selecionar arquivo:</label></p>
                <p><img src="fotos/<?php echo $registro['foto'];?>" width="10%" height="10%" id="visualizar_imagem"></p>
                <p><input type="file" name="arquivo" id="arquivo"></p>
                
                
                <script>
		function carregaImagem(){
			if (this.files && this.files[0]){
				var file = new FileReader();
				file.onload = function(e)
				{
					document.getElementById("visualizar_imagem").src = e.target.result;
				};
				file.readAsDataURL(this.files[0]);
			}
		}
		document.getElementById("arquivo").addEventListener("change", carregaImagem, false);
		
	</script>
                 <p><input type="submit" value="Atualizar Professor(a)" name="atualizar"></p>
        </form>
	</main>

	<footer>
    	Design by Nara
    </footer>
    
    
    
</body>
</html>