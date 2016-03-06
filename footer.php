<footer>
	<h6><?php if (isset($_SESSION['startTime'])) { 
		echo "You are currently logged in as " . $_SESSION['userName']; }
		else { echo "You are not currently logged in"; } ?></h6>
	<h6>This site is part of a CSU CT 310 Course Project." The text "CT 310" will be a link to the course homepage</h6>
</footer>
</body>
</html>
