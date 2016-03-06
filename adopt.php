<?php
session_start ();
include 'header.php';
include 'nav.php';
?>
<body>
  <div id = "availableanimals">
		<div class = "animals">
			<a href="dog1.php">
				Dogs </a>
			<div class  = "dogsymbol">
				<img src="animalsymbols/dogsymbol.png" height="75" width="75">
			</div>

		</div>
		<div class = "animals">
			<a href="cat1.php">
				Cats </a>
			<div class = "catsymbol">
				<img src="animalsymbols/catsymbol.png" height="75" width="75">
			</div>

		</div>
		<div class = "animals">
			<a href="horse1.php">
				Horses </a>
			<div class = "horsesymbol">
				<img src="animalsymbols/horsesymbol.jpg" height="75" width="75">
			</div>

		</div>
		<div class = "animals">
			<a href="rabbit1.php">
				Rabbits </a>
			<div class = "rabbitsymbol">
				<img src="animalsymbols/rabbitsymbol.png" height="75" width="75">
			</div>

		</div>
	</div>
</body>
