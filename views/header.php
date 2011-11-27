<!-- header.php -->
	<header>
		<div id="main" role="main" class="container_12">

			<div class="grid_12">
				<h1><?php echo $conf ['name']; ?></h1>
				<ul id="nav">
					<li>
						<?php echo '<a href="'.$conf['root'].'index.php">Home</a>'; ?>
					</li>
					<li>
						<a href="<?php echo ROOT_MAIN.'tags/'; ?>">Tags</a>
					</li>
					<?php if ( $_SESSION['type'] == 'admin' ) { ?>
					<li>
					<?php include(ROOT_HELPERS.'bouton.php'); } ?>
					</li>
					<li>
						<a href="#" id="loginClick">Login</a>

								<div id="loginContainer">
								<form  id="loginFieldset" action="<?php echo $conf['root']; ?>" enctype="application/x-www-form-urlencoded" method="post" name="item-1" id="item-1">
										<label>Login <br><input type="text" name="login" id="item-4"></label>
										<br><label>Password <br><input type="password" name="password" id="item-5"><br></label>
										<br>
										<input type="submit" id="item-7">
										<?php	if( $_SESSION['type'] == "admin" ) { echo '<a href="?q" id="unLog">✌</a>'; } ?>
								</form>
								</div>

					</li>
				</ul>
			</div>
		</div>
	</header>
<!-- /header.php -->
