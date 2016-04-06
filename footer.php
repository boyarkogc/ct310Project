<footer>
	<h6><?php if (isset($_SESSION['userName'])) { 
		echo "You are currently logged in as " . $_SESSION['userName'];
		}else { echo "You are not currently logged in"; }?></h6>
	<h6>This site is part of a CSU <a href="https://www.cs.colostate.edu/~ct310/yr2016sp/index.php">CT 310</a> Course Project.</h6>
</footer>
</body>
</html>
