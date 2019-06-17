<?php session_start(); 
if(!isset($_SESSION['login']) == true and !isset($_SESSION['senha'])==true)
{
	unset ($_SESSION['login']);
  	unset ($_SESSION['senha']);
  	header('location:index.html');
}	
?> 
<!doctype html>
<html>
<head>
<script language="Javascript">
function confirmacao(id) {
     var resposta = confirm("Deseja remover esse registro?");
 
     if (resposta == true) {
          window.location.href = "form_busca.php?excluir&matricula="+id;
     }
}
</script>
<meta charset="utf-8">
<title>Formulário de pesquisa</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/estilo_do_menu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        <fieldset>
        <legend>Formulário de Pesquisa</legend>
        <form action="#" method="get">
        <p><label>Digite o nome do professor que deseja buscar:</label></p>
        <p><input type="text" name="valor_de_busca" size="50" required> </p>
        <p><input type="submit" name="buscar" value="Pesquisar"></p>
        </form>
       
        <?php
            if(isset($_GET['buscar']))
            {
                $valor = $_GET['valor_de_busca'];
                
                try
                {
                    $con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));			
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $comando_sql = "SELECT * FROM tabela_professor WHERE nome LIKE '%$valor%'";
                    $consulta = $con->query($comando_sql);
                    print "<p>Resultado:</p>";
					
					print "<table class='table table-striped'>
								  <thead>
									<tr>
									  <th scope='col'>Matrícula</th>
									  <th scope='col'>Nome</th>
									  <th scope='col'>Foto</th>
									  <th scope='col'>Edições</th>
									</tr>
								  </thead>
								  <tbody>";
                    
                    while($registro = $consulta->fetch(PDO::FETCH_ASSOC))
                    {
						print "	<tr>
									 <td>{$registro['matricula']}</td>
									 <td>{$registro['nome']}</td>
									 <td><img src='fotos/{$registro['foto']}' width='100' height='100' style='border-radius: 50px;'></td>
									 <td><a href='javascript:func()' onclick=\"confirmacao('{$registro['matricula']}')\"><img src='imagens/excluir.png' title='Excluir registro' with='16px' height='16px'></a>
							  			  <a href='form_editar.php?matricula={$registro['matricula']}'><img src='imagens/editar.png' title='Editar registro' with='16px' height='16px'></a></td>
									</tr>";
                    }
					
					print "</tbody>
							</table>";
                                                
                }
                catch(PDOException $e)
                {
                    print "Erro ocorrido:" . $e->getMessage();					
                }
            }
            else if(isset($_GET['excluir']))
            {
                $matricula = $_GET['matricula'];
                $con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
                $comando_sql = "DELETE FROM tabela_professor WHERE matricula = :valor";
                $stmt = $con->prepare($comando_sql);
                $stmt->bindParam(':valor', $matricula);
                $stmt->execute();
                $rs = $stmt->rowCount();
                if($rs)
                {
                    echo "<script>alert('Registro apagado com sucesso!');</script>";
                }
                else
                {
                    echo "<script>alert('Não foi possível excluir!');</script>";
                }
            }
        ?>
        
        </fieldset>
    </main>
    
    <footer>
    	Design by Nara
    </footer>
</body>
</html>
