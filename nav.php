<ul>
  <li><a href="index.php">Home</a></li>
  <!-- <li><a href="about.php">About Us</a></li> -->
  <?php if (!isset($_SESSION['userName'])): ?>
  <li><a href="login.php">Login</a></li>
  <?php else: ?>
  <li><a href="logout.php">Logout</a></li>
  <?php endif; ?>
</ul> 