  <div id = "links">
		<nav>
			<a href="index.php">
				Home</a>

			<a href="login.php">
					Log in</a>

			<a href="aboutus.php">
				About us</a>

			<a href="availableanimals/index.php">
				Our Adoptable Animals</a>

			<a href="contactus.php">
				Contact us</a>

      <?php if (!isset($_SESSION['userName'])): ?>
      <a href="login.php">Login</a>

      <?php else: ?>
      <a href="logout.php">Logout</a>
      <?php endif; ?>
		</nav>
	</div>
