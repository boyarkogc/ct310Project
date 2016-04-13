<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Greg Boyarko, Alexander Hennings" />
		<meta name="description" content="The Header, including title and URL bar, for a fake adoption site."/>
		<title>Animal Rescue and Adoption Center</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="Header">
			<img src="Media/pawprint.png">
			<div class="MainTitle">Animal Rescue and Adoption Center</div>
			<ul class="URLbar">
				<li class="Links"> 
					<a href="index.php">HOME</a>
				</li>
				<li class="Links">
					<a href="about.php">ABOUT US</a>
				</li>
				<li class="Links">
					<a href="theanimals.php">ADOPTABLE DOGS</a>
				</li>
				<?php if(isset($_SESSION["username"])): ?>
					<li class="Links">				
						<a href="logout.php">LOGOUT</a>
					</li>
				<?php else: ?>
					<li class="Links">				
						<a href="login.php">LOGIN</a>
					</li>
				<?php endif; ?>	
			</ul>
		</div>
	</body>
</html>
