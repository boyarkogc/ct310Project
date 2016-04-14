<!DOCTYPE html>
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
					<a href="theanimals.php">ADD AN ANIMAL</a>
				</li>
				<li class="Links">				
					<a href="logout.php">LOGOUT</a>
				</li>
			<?php else: ?>
				<li class="Links">
					<a href="add_pet.php">ADD AN ANIMAL</a>
				</li>
				<li class="Links">				
					<a href="login.php">LOGIN</a>
				</li>
			<?php endif; ?>	
		</ul>
</div>

