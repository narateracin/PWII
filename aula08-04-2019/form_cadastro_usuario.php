<?php
	if(isset($_GET['cadastrar']))
	{
		try
		{
			$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
		
			$id = 0;	
			$login = $_GET['login'];
			$senha = md5($_GET['senha']);
			$nome = $_GET['nome'];
			$tipo = $_GET['tipo'];
			
			$sql = "INSERT INTO tabela_usuarios(id, login, senha, nome, tipo) VALUES(?, ?, ?, ?, ?)";
			
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(1,$id);
			$stmt->bindParam(2,$login);
			$stmt->bindParam(3,$senha);
			$stmt->bindParam(4,$nome);
			$stmt->bindParam(5,$tipo);
			$resultado = $stmt->execute();
			
			if($resultado)
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
<title>Cadastro de Usuário</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/estilo_do_menu.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
    	<img src="imagens/logo_etec_2019.png">
    </header>

	<nav>
    	<ul>
        	<li><a href="index.html">Login</a></li>
        </ul>
    </nav>


	<main>
    <center>
    <section style=" width:460px; height: 260px; text-align: center;">
        <form action="#" method="get">
                <p><label>Login:</label>
                <input type="text" name="login" size="15" required></p>
                
                <p><label>Senha:</label>
                <input type="password" name="senha" size="15" required></p>
                
                <p><label>Nome:</label>
                <input type="text" name="nome" size="50" required></p>
                
				<select name="tipo">
                    <option value="selecione" selected="" disabled="">Selecione</option>
                    <option value="comum">Comum</option>
                    <option value="super">Super</option>
                    <option value="master">Master</option>
                </select>
                
                <p><input type="submit" value="Cadastrar usuário" name="cadastrar"></p>
        </form>
    </section>
    </center>
	</main>
    
    <footer>
    	Design by Nara
    </footer>

</body>
</html>