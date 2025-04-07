<?php
include('../utils/connect.php');

?>
<header>
	<a href="" class="logo"><img src="/projects/images/E-cart-logo.jpg" alt="Image or logo here"></a>
	<ul class="navbar">
		<li><a href="/projects/home.php#feature" class="active">Home</a></li>
		<li><a href="/projects/my-orders.php">MyOrders</a></li>
		<li><a href="../user.php">User</a></li>
		<li><a href="../place-order.php">BuyDirect</a></li>
	</ul>
	<form action="home.php" method="GET" class="">
		<input type="text" name="q" class="search-bar" placeholder="Search Anything!!! and enter">
	</form>
	<div class="icons">
		<div class="account ">

			<?php

			if (array_key_exists('user_name', $_SESSION) && !empty($_SESSION['user_name'])) {
				if ($_SESSION['user_role'] == "admin") {
					echo "<a href='/projects/adminF/'>", "visit admin page", "</a>";
				}
				echo "<a href='../user.php'>", $_SESSION['user_name'], "</a>";
				echo "<a style='color:red' href='/projects/account/logout.php'>Log Out</a>";
				echo "<style>.dropdown i {
	                background-color: var(--theme-color);
	            }</style>";
			} else {
				echo "<a href='/projects/account/login.html'>Login</a>
	                <a href='/projects/account/signup.html'>Sign up</a>";
			}
			?>
		</div>
		<a class="search-icon"><i onclick="search()"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
					fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path
						d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
				</svg></i></a>
		<a class="dropdown "><i><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
					class="bi bi-person" viewBox="0 0 16 16">
					<path
						d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
				</svg></i></a>
		<a href="/projects/cart.php" class="trolley">
			<i>
				<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
					class="bi bi-cart2" viewBox="0 0 16 16">
					<path
						d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
				</svg></i><span><?php

								if (isset($_SESSION['user_id'])) {
									$user = $_SESSION['user_id'];
									$sql = "select sum(quantity) as sum from cart where user_id = $user";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) == 1) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo $row['sum'];
										}
									} else {
										echo 0;
									}
								} else {
									echo 0;
								}
								?></span></a>

		<div class="hamburger">
			<a>
				<div class="bar"></div>
			</a>
		</div>
	</div>
</header>
<script>
	const header = document.querySelector('header')
	const menu = document.querySelector('.hamburger');
	const navbar = document.querySelector('.navbar');
	const dropdownbtn = document.querySelector('.dropdown');
	const dropdownBox = document.querySelector('.account');

	window.addEventListener('scroll', () => {
		header.classList.toggle('sticky', window.scrollY > 0)
	})
	menu.onclick = () => {
		navbar.classList.remove('search')
		navbar.classList.toggle('open');
	}
	window.onscroll = () => {
		navbar.classList.remove('open')
	}
	dropdownbtn.onmouseenter = function() {
		dropdownBox.classList.toggle('show');
	}
	dropdownBox.onmouseenter = function() {
		dropdownBox.classList.toggle('show');
	}
	dropdownbtn.onmouseleave = () => {
		dropdownBox.classList.toggle('show')
	}
	dropdownBox.onmouseleave = function() {
		dropdownBox.classList.toggle('show');
	}

	
</script>