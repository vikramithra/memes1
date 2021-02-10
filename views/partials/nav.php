

<header>
	<a href="/" class="logo">
		<h1 class="logo-text">Meme<span>logy</span></h1>
	</a>
	<i class="fa fa-bars menu-toggle"></i>
	<ul class="nav">

		
		<li><a href="/">Home</a></li>
		
		<?php if (isset($_SESSION['user_details'])): ?>
			<li>
				<a href="#">
					<i class="fa fa-user"></i>
					<?php echo$_SESSION['user_details']['username']; ?>
						Memeology
					<i class="fa fa-chevron-down" style="font-size: .8em;"></i>
				</a>		
				<ul>
				<?php if($_SESSION["user_details"]['admin']): ?>
					<li><a href="/admin/dashboard.php">Dashboard</a></li>
				<?php endif; ?>
					
					<li><a href="../../logout.php" class="../../logout.php">Logout</a></li>
				</ul>
			</li>
		<?php else: ?>	
			<li><a href="<?php echo '../register.php' ?>">Sign up</a></li>
			<li><a href="<?php echo '../login.php' ?>">Login</a></li>
		<?php endif; ?>	
			

	</ul>
</header>
