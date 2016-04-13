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