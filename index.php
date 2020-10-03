<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Rexx Systems - Code Challenge</title>
<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>

<body class="center">
	<h1 class="color-blue">Rexx Systems - Code Challenge</h1>
	
	<!-- From to Upload a JSON file -->
	<fieldset class="center">
		<legend>JSON File Upload</legend>
			<form action="upload_action.php" method="post" enctype="multipart/form-data">
				<label for="file">Select a file to upload:</label>
				<input type="file" name="file" tabindex="1" size="100" placeholder="No file selected..." /></br></br></br>
				<button type="submit" value="upload" tabindex="2">Upload...</button>
			</form>
	</fieldset>
	
    	<!-- Result of Upload -->
	<?PHP
	if (isset($_GET['status'])):
	?>
	<fieldset class="center">
		<legend>Result</legend>
		<?PHP
		if ($_GET['status'] == 1):
		?>
			<p class="color-red bold-font">Selected file is not a JSON file</p>
		<?PHP
		endif;
		?>
		<?PHP
		if ($_GET['status'] == 2):
		?>
			<p class="color-red bold-font">The file already exists</p>
		<?PHP
		endif;
		?>
		<?PHP
		if ($_GET['status'] == 3):
		?>
			<p class="color-green bold-font">JSON data file has been successfully uploaded and stored in database</p>
			<form action="explore.php" method="get">
				<button type="submit">View the Data</button>
			</form>
		<?PHP
		endif;
		?>
	</fieldset>
	<?PHP
	endif;
	?>
	
</body>
</html>