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
<title>Página Principal - Usuário:<?php echo $_SESSION['usuario'];?></title>
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
        	<li><a href="#">Home</a></li>
            <li><a href="form_cadastro.php">Cadastrar Aluno</a></li>
            <li><a href="form_busca_aluno.php">Buscar Alunos</a></li>
            <li><a href="form_cadastro_professor.php">Cadastrar Professor</a></li>
            <li><a href="form_busca.php">Buscar Professores</a></li>
            <li><a href="form_exibir_professores.php">Exibir Professores</a></li>
            <li><a href="#">Usuário logado:  <?php echo $_SESSION['usuario'];?></a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
    
    <main>
    	<section>
        	<div class="media">
                  <img src="https://cdn1.i-scmp.com/sites/default/files/styles/64x64/public/2014/07/28/cat.jpg?itok=AoBlhIno" class="mr-3" alt="...">
                  <div class="media-body">
                    <h5 class="mt-0">Media heading</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
			</div><br>
            
        	<div class="media">
                  <img src="https://cdn1.i-scmp.com/sites/default/files/styles/64x64/public/2014/07/28/cat.jpg?itok=AoBlhIno" class="mr-3" alt="...">
                  <div class="media-body">
                    <h5 class="mt-0">Media heading</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
			</div><br>
            
            <div class="media">
                  <img src="https://cdn1.i-scmp.com/sites/default/files/styles/64x64/public/2014/07/28/cat.jpg?itok=AoBlhIno" class="mr-3" alt="...">
                  <div class="media-body">
                    <h5 class="mt-0">Media heading</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
			</div>
        </section>
    </main>
    
    <footer>
    	Design by Nara
    </footer>
</body>
</html>