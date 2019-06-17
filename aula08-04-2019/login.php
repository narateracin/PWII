<?php
	session_start();
	$login = $_POST['login'];
	$senha = md5($_POST['senha']);
	$con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
	$cmd_sql = "SELECT * FROM tabela_usuarios WHERE login = ? AND senha = ?";
	
	$busca = $con->prepare($cmd_sql);
	$busca->bindParam(1, $login);
	$busca->bindParam(2, $senha);
	$busca->execute();
	$campo = $busca->fetch(PDO::FETCH_ASSOC);
	$_SESSION['usuario'] =  $campo['nome'];
	
	if($busca->rowCount()>0)
	{
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		header('location:index.php');			
	}
	else
	{
		unset ($_SESSION['login']);
  		unset ($_SESSION['senha']);
  		header('location:index.html');
	}
	$con=null;

?>
