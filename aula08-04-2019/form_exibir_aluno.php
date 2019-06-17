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
<meta charset="utf-8">
<title>Relatório de Professores</title>

<style type="text/css">
tr.par{background-color:#CCCCCC;}
tr.impar{background-color:#FAFAFA;}
</style> 

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
        <table border="1", align="center">
            <tr>
                <th colspan="7">RELATÓRIO DE ALUNOS</th>
            </tr>
            
            <tr class="par">
                <th>Matricula</th>
                <th>Nome do Professor</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Valor</th>
                <th>Link da Foto</th>
            </tr>
        <?php
            $linha = 1;
            
            try
            {
                $conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw', array (PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                $consulta = $conexao->query("SELECT * FROM tabela_aluno ORDER BY matricula DESC");
        
                
                while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
                {
                    if($linha%2==0)
                    {
                        $class="par";
                    }
                    else
                    {
                        $class="impar";
                    }
                    
                    echo "<tr class='" . $class . "'>";
                    echo "<td>{$campo['matricula']}</td>";
                    echo "<td>{$campo['nome']}</td>";
                    echo "<td>{$campo['email']}</td>";
                    echo "<td>{$campo['telefone']}</td>";
                    echo "<td>{$campo['data']}</td>";
                    echo "<td>{$campo['valor']}</td>";
					echo "<td><img src='fotos_alunos/{$campo['foto']}' width='50' height='50' style='border-radius: 20%;'></td>";
                    echo "</tr>";
                    
                    $linha = $linha + 1;
                }
                
                
            }
            catch(PD0Excepction $e)
            {
                echo "Erro:" . $e->getMessage();
            }
        ?><!--Fechando um script php-->
        </table>
    </main>
        
    <footer>
    	Design by Nara
    </footer>
</body>
</html>