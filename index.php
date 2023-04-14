<?php 
	
	$conn = mysqli_connect('localhost','root','','loja');

	if(!$conn)
	{
		die(mysqli_error());
	}

	if(isset($_POST['Salvar']))
	{

		$targetFolder = "uploads";
		$errorMsg = array();
		$successMsg = array();

		foreach($_FILES as $file => $fileArray)
		{
			
			if(!empty($fileArray['name']) && $fileArray['error'] == 0)
			{
				$getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);;

				if(($getFileExtension =='jpg') || ($getFileExtension =='jpeg') || ($getFileExtension =='png') || ($getFileExtension =='gif'))
				{
					if ($fileArray["size"] <= 500000) 
					{
						$breakImgName = explode(".",$fileArray['name']);
						$imageOldNameWithOutExt = $breakImgName[0];
						$imageOldExt = $breakImgName[1];

						$newFileName = strtotime("now")."-".str_replace(" ","-",strtolower($imageOldNameWithOutExt)).".".$imageOldExt;

						
						$targetPath = $targetFolder."/".$newFileName;

						
						if (move_uploaded_file($fileArray["tmp_name"], $targetPath)) 
						{
							
							$qry ="insert into imagem (arqImagem) values ('".$newFileName."')";


							$rs  = mysqli_query($conn, $qry);

							if($rs)
							{
								$successMsg[$file] = "Imagem carregada com sucesso";
							}
							else
							{
								$errorMsg[$file] = "Erro ao salvar arquivo ".$file." ";
							}
						}
						else
						{
							$errorMsg[$file] = "Erro ao salvar arquivo ".$file."  ";		
						}
					} 
					else
					{
						$errorMsg[$file] = "Tamanho da Imagem muito grande no arquivo ".$file;
					}

				}
				else
				{
					$errorMsg[$file] = 'Apenas arquivos de imagem permitidos na posição '.$file.' ';
				}	
			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Como fazer upload de varias images na base mysql</title>
<link rel="stylesheet" href="style.css" type='text/css'>
</head>
<body>
	<div class="form-container">

	<?php 
		if(isset($successMsg) && !empty($successMsg))
		{
			echo "<div class='success-msg'>";
			foreach($successMsg as $sMsg)
			{
				echo $sMsg."<br>";
			}
			echo "</div>";
		}
	?>


	<?php 
		if(isset($errorMsg) && !empty($errorMsg))
		{
			echo "<div class='error-msg'>";
			foreach($errorMsg as $eMsg)
			{
				echo $eMsg."<br>";
			}

			echo "</div>";
		}
	?>

	<div class="add-more-cont"><a id="moreImg"><img src="img/add_icon.jpg">Adicionar Imagem</a></div>
	<form name="uploadFile" action="" method="post" enctype="multipart/form-data" id="upload-form">
		<div class="input-files">
		<input type="file" name="image_upload-1">
		</div>
		<input type="submit" name="Salvar" value="Salvar">
	</form>
	
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			var id = 1;
			$("#moreImg").click(function(){
				var showId = ++id;
				if(showId <=10)
				{
					$(".input-files").append('<input type="file" name="image_upload-'+showId+'">');
				}
			});
		});
	</script>
</body>
</html>