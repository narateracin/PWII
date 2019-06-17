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
			$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			
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
			$pasta = "fotos/";
			
			$comando_sql = "INSERT INTO tabela_professor(matricula,nome,email,telefone,celular,data_nascimento,valor,foto)VALUES(:valor1,:valor2,:valor3,:valor4,:valor5,:valor6,:valor7,:valor8)";
			
			$stmt = $conexao->prepare($comando_sql);
			$stmt->bindParam(':valor1', $matricula);
			$stmt->bindParam(':valor2', $nome);
			$stmt->bindParam(':valor3', $email);
			$stmt->bindParam(':valor4', $telefone);
			$stmt->bindParam(':valor5', $celular);
			$stmt->bindParam(':valor6', $data_nascimento);
			$stmt->bindParam(':valor7', $valor);
			$stmt->bindParam(':valor8', $nome_final);
			
			
			$rs = $stmt->execute();
			
			if ($rs and move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
			{
				echo "<script>alert('Cadastrado com sucesso!');</script>";
			}
			else
			{
				echo var_dump($stmt->errorInfo());
			}
			
		}
		catch (PDOException $e)
		{
			echo "Erro:" . $e->getMessage();	
		}
	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulário de Cadastro de Professor - Usuário:<?php echo $_SESSION['usuario'];?></title>
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
                <input type="number" size="5" name="matricula" required></p>
                
                <p><label>Nome do Professor(a):</label>
                <input type="text" name="nome" size="50" required></p>
                
                <p><label>E-mail:</label>
                <input type="text" name="email" size="50" required></p>
                
                <p><label>Telefone:</label>
                <input type="text" name="telefone" size="15" required></p>
                
                <p><label>Celular:</label>
                <input type="text" name="celular" size="15"></p>
              
                <p><label>Data de Nascimento:</label>
                <input type="date" name="data_nascimento"></p>
                
                <p><label>Valor:</label>
                <input type="text" name="valor"></p>
                
                <p><label>Selecionar arquivo:</label></p>
                <p><input type="file" name="arquivo"></p>
                
                 <p><input type="submit" value="Cadastrar Professor(a)" name="cadastrar"></p>
        </form>
	</main>

	<footer>
    	Design by Nara
    </footer>
    
</body>
</html>