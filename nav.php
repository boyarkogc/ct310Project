<div id = "links">
	<nav>
		<a href="index.php">Home</a>

		<a href="about.php">About us</a>
		
		<a href="adopt.php">Our Adoptable Animals</a>

    	<?php if (!isset($_SESSION['userName'])): ?>
    	<a href="login.php">Login</a>
    	<?php else: ?>
    	<a href="logout.php">Logout</a>
    	<?php endif; ?>
	</nav>
</div>