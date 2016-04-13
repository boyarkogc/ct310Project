<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Baradji Diallo, Alexander Hennings" />
		<meta name="description" content="The necessary footer for a Fake Adoption Site."/>
		<title>Fake Adoption Footer</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="Footer">
			<div class="LoggedIn">
				<?php if (isset($_SESSION['username'])) { 
					echo "You are currently logged in as " . $_SESSION['username'] . ".";
				}else { 
					echo "You are not currently logged in"; }
				?>
			</div>
			<div class="warning">This site is part of a CSU <a href="https://www.cs.colostate.edu/~ct310/yr2016sp/"> CT 310 </a> Course Project created by Greg Boyarko and Alexander Hennings.</div>
		</div>	
	</body>
</html>
