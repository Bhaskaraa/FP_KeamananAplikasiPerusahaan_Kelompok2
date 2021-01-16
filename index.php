<!DOCTYPE html>
<html>
<head>
	<title>Upload Disini Bang</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<center>
    <header id="header" class="alt">
	<div class="inner">
	    <h1>Upload Upload Seru<br> Kelompok DAD</h1>
	    <form method="post" action="upload.php" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" name="upload_btn" value="Upload">
	</form>
</div>
</header>
	
		<?php
			//panggil koneksi database
			include "database.php";

			$view = mysqli_query($db, "SELECT * from upload");
			while($data = mysqli_fetch_array($view)):
		?>
		<tr>
			<td>
				<img src="<?php echo "fileupload/".$data['file_name'] ?>">
			</td>
		</tr>
	<?php endwhile;?>

</center>
</body>
</html>
