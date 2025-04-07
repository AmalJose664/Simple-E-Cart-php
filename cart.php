<!DOCTYPE html>
<?php

session_start();
include('./utils/connect.php');
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}

?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cart</title>
	<link rel="stylesheet" href="./utils/colors.css">
	<link rel="stylesheet" href="./styles/cart.css">
	<link rel="stylesheet" href="./styles/home.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
</head>

<body><a style=" margin-top: 50px; float: right; text-decoration: none; padding: 8px; background: var(--low-accent); border-radius: 8px;" href="<?php if (isset($_SERVER['HTTP_REFERER'])) {
																																					echo $_SERVER['HTTP_REFERER'];
																																				}
																																				?>">Go back</a>
	<?php

	include('./navbar.php');
	?>
	<div class="container">
		<?php
		echo "<h2>" . $_SESSION['user_name'] . "'s cart</h2>";
		?>
		<?php
		$user = $_SESSION['user_id'];
		$sql = " select * from cart inner join products on cart.item_id=products.pid where user_id=$user";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) != 0) {

		?>
			<div class="box34">
				<div class="inbox">

					<?php

					while ($row = mysqli_fetch_assoc($result)) {
						$stock = $row['pro_stocks'];
					?>
						<div class="item shadow-hover">
							<div class="left">
								<div class="image">
									<img onclick="navigate('<?php echo $row['pid'] ?>')" src="./product-images/<?php echo $row['pro_src'] ?> " alt="image">
								</div>
							</div>
							<div class="right">
								<div class="name">
									<?php echo "<p>" . $row['pro_simple_name'] . "</p>";
									if ($stock > 1) { ?>
										<div class="stocks">
											<p>&#10004; <custom>InStocks</custom>
											</p>

										</div>
									<?php } else {
										echo "<div class='stocks red'>
										<p> &#10006; <custom>Not Available</custom> </p>
										
										</div>";
									}
									?>

									<div class="delete">
										<form action="add-to-cart.php" method="post">
											<input type="number" name="pro-id" hidden value="<?php echo $row['pid'] ?>">
											<input type="number" name="pro-price" hidden value="<?php echo $row['pro_discount_price'] ?>">
											<input type="text" name="action" value="delete" hidden>
											<button name="submit" value="submit">&times;</button>
										</form>
									</div>
								</div>
								<div class="cart-quantity">
									<div class="q">
										Items
									</div>
									<div class="q">

									</div>
									<div class="q">
										Rate
									</div>
									<hr>
									<hr>
									<hr>
									<div class="cart-display-quantity s">
										<?php echo $row['quantity'] ?>
									</div>
									<div class="multiply s">
										X
									</div>
									<div class="cart-rate s">

										₹<?php echo $row['pro_discount_price'] ?>
									</div>
								</div>

								<div class="quantity">
									<form action="./add-to-cart.php" method="post" class="form-quantity">
										<input type="number" name="pro-id" hidden value="<?php echo $row['pid'] ?>">
										<input type="number" name="pro-price" hidden value="<?php echo $row['pro_discount_price'] ?>">
										<input type="text" name="action" value="decrease" hidden>
										<button name="submit" value="submit">
											-
										</button>
									</form>
									<p><?php echo $row['quantity'] ?></p>
									<form action="./add-to-cart.php" method="post" class="form-quantity">
										<input type="number" name="pro-id" hidden value="<?php echo $row['pid'] ?>">
										<input type="number" name="pro-price" hidden value="<?php echo $row['pro_discount_price'] ?>">
										<input type="text" name="action" value="increase" hidden>
										<input type="text" name="quantity" value="<?php echo $row['quantity'] ?>" hidden>
										<button name="submit" value="submit">
											+
										</button>
									</form>
								</div>
								<div class="item-total">
									₹ <?php echo $row['total_price'] ?>
								</div>
							</div>
						</div>
					<?php

					}

					?>



				</div>

			</div>
			<div class="center">
				<div class="summary shadow-hover">
					<div class="main">
						<div class="head">
							Summary
						</div>
						<div class="content">
							<div class="title">
								<?php
								$sql = " SELECT pro_simple_name,quantity from  cart INNER JOIN products  on cart.item_id = products.pid WHERE user_id = $user";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) != 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<p>" . $row['pro_simple_name'] . " (" . $row['quantity'] . ")</p>";
									}
								}
								?>

							</div>
							<div class="curresponding-price">
								<?php
								$sql = " SELECT total_price from  cart  WHERE user_id = $user";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) != 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<p>₹" . $row['total_price'] . "</p>";
									}
								}
								?>
							</div>
						</div>
						<hr>
						<div class="total">
							<?php
							$sql = " SELECT sum(total_price) as total from  cart WHERE user_id = $user";
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) != 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<p>₹" . $row['total'] . "</p>";
								}
							}
							?>
						</div>
						<div class="button">
							<button class="confirm-btn">
								<a href="place-order.php">Confirm Order</a>
							</button>
						</div>
					</div>
				</div>
			</div>
		<?php
		} else {
			echo "<h2>We think your Cart is Empty!!!</h2><br>
								<a href='home.php#feature' class='confirm-btn'>Fill my Cart</a>";
		}
		?>
		<!-- 
	/////////////////endof cart///////////////////////////////////////// -->



	</div>
	<?php

	include('./utils/footer.php');
	?>
</body>
<script src="./utils/colors.js" defer></script>
<script>
	const cartNum = document.querySelector('.trolley span')
	console.log(cartNum.innerHTML);

	if (cartNum.innerHTML == "") {
		cartNum.remove()
	}

	function cart(e) {

		if (cartNum.innerHTML >= 10) {
			alert("Maximum cart reached")
			e.preventDefault();
		}

	}

	function navigate(id) {
		location.href = "product.php?item=" + id;
	}
</script>

</html>