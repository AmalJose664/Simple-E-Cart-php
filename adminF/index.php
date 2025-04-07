<?php

include('../utils/admin-checker.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admins Only !!!</title>
	<link rel="stylesheet" href="./styles-admin/styleAdmin.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="../utils/colors.css">
	<link rel="stylesheet" href="../styles/home.css">

</head>

<body>
	<?php include('./admin-nav.php') ?>
	<main>
		<div class="container">
			<h1>Admin Functions </h1>
			<div class="box">
				<a href="./all-users.php" class="functions">
					<div>
						All Users
					</div>
				</a>
				<a href="./all-product.php" class="functions">
					<div>
						All Products
					</div>
				</a>
				<a href="./all-orders.php" class="functions">
					<div>
						All Orders
					</div>
				</a>
				<a href="add-product.php" class="functions">
					<div>
						Add Products
					</div>
				</a>

			</div>
		</div>
	</main>
	<section class="contact">
		<div class="main-contact">
			<div class="contact-content">
				<h5>Getting Started?</h5>
				<li><a href="">Release notes</a></li>
				<li><a href="">Upgrade Guide</a></li>
				<li><a href="">Browser Support</a></li>
				<li><a href="">Dark mode</a></li>
			</div>
			<div class="contact-content">
				<h5>Explore</h5>
				<li><a href="">Prototyping</a></li>
				<li><a href="">Design Systems</a></li>
				<li><a href="">Pricing</a></li>
				<li><a href="">Learn design</a></li>
			</div>
			<div class="contact-content">
				<h5>Resourses</h5>
				<li><a href="">Best Practices</a></li>
				<li><a href="">Support</a></li>
				<li><a href="">Developers</a></li>
				<li><a href="">Learn design</a></li>
			</div>

			<div class="contact-content">
				<h5>Community</h5>
				<li><a href="">Discussion Forms</a></li>
				<li><a href="">Code of Conduct</a></li>
				<li><a href="">Contributing</a></li>
				<li><a href="">API References</a></li>
			</div>
		</div>

	</section>
	<script src="../utils/colors.js" defer></script>
</body>

</html>