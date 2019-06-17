<?php session_start(); 
if(!isset($_SESSION['login']) == true and !isset($_SESSION['senha'])==true)
{
	unset ($_SESSION['login']);
  	unset ($_SESSION['senha']);
  	header('location:index.html');
}	
?> 

<?php
	if(isset($_POST['cadastrar']))
	{
		try
		{
			$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
			// Recuperando dados do formulário
			$matricula = $_POST['matricula'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$telefone = $_POST['telefone'];
			$data = $_POST['data'];
			$valor = $_POST['valor'];
			$arquivo = $_FILES['arquivo'];
			
			$nome_arquivo = $_FILES['arquivo']['name'];
			$extensao = explode(".", $nome_arquivo);
			$nome_final = md5(time()) . "." . $extensao[1];
			$pasta = "fotos/";
			
			$sql = "INSERT INTO tabela_aluno(matricula,nome,email,telefone,data,valor,foto) VALUES(:valor1,:valor2,:valor3,:valor4,:valor5,:valor6,:valor7)";
			
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(":valor1",$matricula);
			$stmt->bindParam(":valor2",$nome);
			$stmt->bindParam(":valor3",$email);
			$stmt->bindParam(":valor4",$telefone);
			$stmt->bindParam(":valor5",$data);
			$stmt->bindParam(":valor6",$valor);
			$stmt->bindParam(":valor7",$nome_final);
			
			$resultado = $stmt->execute();
			
			if($resultado and move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
			{
				echo "<script>alert('Dados gravados com sucesso!');</script>";
			}
			else
			{
				echo var_dump($stmt->errorInfo());
			}
		}
		catch (PDOException $e)
		{
			echo "Erro:". $e->getMessage();	
		}
		
	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulário de Cadastro de Aluno</title>

<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/estilo_do_menu.css" rel="stylesheet" type="text/css">
<link href="css/grid.css" rel="stylesheet" type="text/css">
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
        
            <div>
                <section class="container grid grid-template-columns">
                    <div class="item"><label>Número de matrícula:</label></div>
                    <div class="item"><input type="number" size="5" name="matricula" required></div>
                    
                    <div class="item"><label>Nome completo do aluno:</label></div>
                    <div class="item"><input type="text" size="50" name="nome" required></div>
                    
                    <div class="item"><label>E-mail:</label></div>
                    <div class="item"><input type="text" size="50" name="email" required></div>
                    
                    <div class="item"><label>Telefone:</label></div>
                    <div class="item"><input type="text" size="15" name="telefone" required></div>
                    
                    <div class="item"><label>Data:</label></div>
                    <div class="item"><input type="date" name="data" required></div>
                    
                    <div class="item"><label>Valor:</label></div>
                    <div class="item"><input type="text" name="valor" required></div>
                    
                    <div class="item"><label>Selecionar arquivo:</label></div>
					<div class="item"><input type="file" name="arquivo"></div>
                    
                    <div class="grid"><input type="submit" value="Cadastro de Alunos" name="cadastrar"></div>
                 </section>
            </div>
        </form>
   </main>
     
     <footer>
    	Design by Nara
    </footer>
</body>
</html>