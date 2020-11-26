<!doctype html>
<html lang="lv">
	<head>
		<meta charset="UTF-8">
		<title>
			CSV=>DB
		</title>
	</head>
	<body>
		<form method="post" enctype="multipart/form-data">
			Name: <input type="file" name="csvfile" accept=".csv">
			<input type="submit" value="upload" value="Uzlādēt">
		</form>
	</body>
	<body>
		<hr> </hr>
		Atļautie faili *<?php echo implode(", *" ,array('.csv', '.txt', '.hvi'));?><br>
		Maksimālais izmērs <?php echo ini_get('upload_max_filesize')?><br>
		<hr></hr>
		<?php
			$path="./"; //$path="/home/vb/www/files/"; 
			$tmpfile=$_FILES['csvfile']['tmp_file'];
			$newFile = $path. basename($_FILES['csvfile']['name']);
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
					if (file_exists($newFile))
				{
					unlink($newFile);
				}
				if(move_uploaded_file($tmpFile, $newFile)) 
				{
					echo $newFile."Veiksmīgi uzlādēts!<br>";
				}
				else
				{
					echo "Neidevās uzlādēt failu ".$newFile. "<br>";
				}
			}
		?>
		<hr> </hr>
		<?php
		if (file_exists($newFile)){
			$saturs=file_get_contents($newFile);
			$dati = explode("\n",$saturs );
		?>
		<table>
		<?php
			foreach($dati as $rindas){
				//print_r($rindas);
				//echo "<br>";ffff
				//fdasf
		?>
		<tr>
		<?php
				$rinda = str_getcsv($rindas, ",");
				//print_r($rinda);
				//echo "<br>";
				foreach($rinda as $vert){
		?>
		<td><?php echo $vert?><td>
		<?php
				}
		?>
		</tr>
		<?php
			}
		?>
		</table>
		<?php
			}
		
		?>
	</body>
</html>