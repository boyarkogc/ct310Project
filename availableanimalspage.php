<?php
session_start ();
include 'header.php';
include 'nav.php';
?>
<body>
  <div id = "availableanimals">
		<div id = "animals">
			<a href="dogs/">
				Dogs </a>
			<div id = "dogsymbol">
				<img src="animalsymbols/dogsymbol.png" height="75" width="75">
			</div>

		</div>
		<div id = "animals">
			<a href="cats/">
				Cats </a>
			<div id = "catsymbol">
				<img src="animalsymbols/catsymbol.png" height="75" width="75">
			</div>

		</div>
		<div id = "animals">
			<a href="horses/">
				Horses </a>
			<div id = "horsesymbol">
				<img src="animalsymbols/horsesymbol.jpg" height="75" width="75">
			</div>

		</div>
		<div id = "animals">
			<a href="rabbits/">
				Rabbits </a>
			<div id = "rabbitsymbol">
				<img src="animalsymbols/rabbitsymbol.png" height="75" width="75">
			</div>

		</div>
	</div>
</body>
