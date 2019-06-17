<?php
	if(isset($_POST['enviar']))
	{
		$arquivo = $_FILES['arquivo'];
		$nome = $_FILES['arquivo']['name'];
		$extensao = explode(".", $nome);
		$nome_final = md5(time()) . "." . $extensao[1];
		$pasta = "fotos/";
		if (move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
		{
			echo "Arquivo enviado com sucesso!";
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <p><label>Selecionar arquivo:</label></p>
        <p><input type="file" name="arquivo"></p>
        <p><input type="submit" value="Enviar" name="enviar"></p>
    </form>
</body>
</html>