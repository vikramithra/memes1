<header>
		<div class="logo">
			<h1 class="logo-text"><a href="/">Meme<span>logy</span></h1></a>
		</div>
		<i class="fa fa-bars menu-toggle"></i>
		<ul class="nav">
			<?php if (isset($_SESSION['user_details'])): ?>
				<li>
					<a href="#">
						<i class="fa fa-user"></i>
						<?php echo $_SESSION["user_details"]['username']; ?>
						<i class="fa fa-chevron-down" style="font-size: .8em;"></i>
					</a>		
					<ul>
						<li><a href="<?php echo '../../logout.php'; ?>" class="logout">Logout</a></li>
					</ul>
				</li>
			<?php endif; ?>	
		</ul>
	</header>