<!DOCTYPE html>
<?php
session_start();
include('./utils/connect.php');

if (isset($_GET['item'])) {
	$item = mysqli_real_escape_string($conn, $_GET['item']);
} elseif (empty($_GET['item'])) {
	die('please provide a product Id in the links like product.php?item=5002');
}
$in_cart = false;
if(isset($_SESSION['user_id'])){
	$user = $_SESSION['user_id'];
	$check_in_cart = "SELECT * FROM cart WHERE item_id = ? and  user_id = $user";
	$stmt = $conn->prepare($check_in_cart);
	$stmt->bind_param("i", $item); 
	$stmt->execute();
	$check_cart = $stmt->get_result();

	
	if (mysqli_num_rows($check_cart) > 0) {
		$in_cart = true;
	}
}
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/home.css">
	<link rel="stylesheet" href="styles/product.css">
	<link rel="stylesheet" href="utils/colors.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<script defer src="scripts/home.js"></script>
	<title>View Item</title>
</head>

<body>
	<?php include("./navbar.php") ?>
	<div class="big-container">
		<?php
			$sql = "SELECT * FROM products WHERE pid = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $item); // "i" indicates the parameter type is an integer
			$stmt->execute();
			$result = $stmt->get_result();

		if (mysqli_num_rows($result) == 1) {
			while ($row = mysqli_fetch_assoc($result)) {

				// echo $row['pid'];
				// echo $row['pro_simple_name'];
				$discount =  (($row['pro_price'] - $row['pro_discount_price']) / $row['pro_price']) * 100;
				$rating = random_int(10, 50) / 10;
				$stock = $row['pro_stocks'];

		?>
				<div class="product">
					<div class="container ">

						<div class="box">
							<div class="images">
								<div class="date shadow-hover">
									Launched on <?php echo $row['added_date']; ?>
								</div>
								<div class="image">
									<img src="./product-images/<?php echo $row['pro_src'] ?>" alt="altimage">
								</div>

							</div>

						</div>
						<div class="box">
							<div class="details">
								<div class="section shadow-hover">
									<div class="company">
										<p> <?php echo $row['pro_brand'] ?> </p>
									</div>
									<div class="category company">
										<p>Varient:<?php echo $row['pro_type'] ?></p>
									</div>

								</div>
								<div class="title shadow-hover">
									<h2><?php echo $row['pro_name'] ?></h2>
								</div>
								<div class="rate shadow-hover">
									<div class="star ratings ">
										<?php echo  $rating ?>&star;
									</div>
									<div class="reviews-product">
										<?php echo random_int(100, 10000) ?> ratings and <?php echo random_int(100, 10000) ?> reviews
									</div>
								</div>
								<div class="prices-product shadow-hover">
									<p style="text-decoration: line-through;">₹ <i> <?php echo $row['pro_price'] ?></i></p>
									<p>₹<i> <?php echo $row['pro_discount_price'] ?></i></p>
								</div>
								<div class="discount">
									(<?php echo $discount ?> %off)
								</div>
								<div class="<?php
											if ($stock > 1) {
												echo "availability";
											} else {
												echo "availability red";
											}
											?> shadow-hover">
									<div class="text">

										<?php
										if ($stock > 1) { ?>
											<span class="units "><?php echo $row['pro_stocks'] ?></span> Units left
											<div class="home-stocks">
												<p>&#10004;
												</p>
												<p class="s-checker" id='<?php $row['pid'] ?>'>
													In Stock
												</p>

											</div>
										<?php } else {
											echo "<span class='units red'>" . $row['pro_stocks'] . "</span> Units left";
											echo "<div class='home-stocks red'>
										<p> &#10006;  </p><p class='s-checker' id='" . $row['pid'] . "'>Not Available</p>
										
										</div>";
										}
										?>

									</div>
								</div>
								<div>

									<form
										action="add-to-cart.php" onsubmit="cart(event,<?php echo $row['pid'] ?>)" method="post" class="form buttons shadow-hover">
										<input type="number" name="pro-id" value="<?php echo $row['pid'] ?>" hidden>
										<input type="number" name="pro-price" value="<?php echo $row['pro_discount_price'] ?>" hidden>
										<input type="text" name="action" value="increase" hidden>
										<button class="row-btn" name="submit" value="submit">Add to Cart <?php 
									if($in_cart){
										echo "&#10004;";
									}
									?></button>
									</form>

									<div style="display: inline-flex;">
										<form onsubmit="cart(event,<?php echo $row['pid'] ?>)" action=" direct-buy.php" method="post">
											<input type="text" hidden value="direct-buy" name="direct-buy">
											<input type="number" value="<?php echo $row['pid'] ?>" name="item" hidden>

											<button type="submit" class="row-btn">Buy Now</button>
										</form>

									</div>
								</div>

								<div class="in-cart shadow-hover">
									<?php 
									if($in_cart){
									
									?>
									<div class="incart">
										<i>
											<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
												class="bi bi-cart2" viewBox="0 0 16 16">
												<path
													d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
											</svg>
										</i>
										<div class="text-show">
											<p>Item Already in cart</p>
										</div>
									</div>

									<?php } ?>

								</div>



							</div>


						</div>
					</div>

				</div>
				<div class="description">
					<div class="head">
						Product Description
					</div>
					<div class="content">
						<?php echo $row['pro_description'] ?>
					</div>
				</div>
	</div>



<?php

			}
		} else {
			echo "<p class='error'>Requested product has not been found</p>";
		}


?>

</div>
<section class="feature">
	<div class="middle-text">
		<h2>
			Discover More <span>Good things.....</span>
		</h2>
	</div>
	<?php



	echo "<div class='feature-content'>";
	$sql = "select * from products ORDER BY RAND()";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$id = $row['pid'];
			//echo "<br>id = " . $row['pid'];
			$discount =  (($row['pro_price'] - $row['pro_discount_price']) / $row['pro_price']) * 100;
			$rating = random_int(10, 50) / 10;
			$stock = $row['pro_stocks'];

	?>
			<div class="row " id="item<?php echo $row['pid'] ?>">

				<div class="main-row">
					<a href="<?php echo "product.php?item=$id" ?>">
						<div class="row-img">
							<img src='./product-images/<?php echo $row['pro_src']; ?>' alt="Product i think" class="row-img">
						</div>
					</a>
					<div class="row-text">

						<a href="<?php echo "product.php?item=$id" ?>">
							<h6>Sponcered By <span><?php echo  $row['pro_brand']; ?></span></h6>

							<?php
							if ($stock > 1) { ?>
								<div class="home-stocks">
									<p>&#10004;
									</p>
									<p class="s-checker" id='<?php $row['pid'] ?>'>
										In Stock
									</p>

								</div>
							<?php } else {
								echo "<div class='home-stocks red'>
										<p> &#10006;  </p><p class='s-checker' id='" . $row['pid'] . "'>Not Available</p>
										
										</div>";
							}
							?>
							<h3><?php echo $row['pro_simple_name']; ?></h3>
						</a>

						<div class="ratings">
							<h5><?php echo $rating ?></h5>&star;
						</div>


						<div class="option">
							<form action="add-to-cart.php" onsubmit="cart(event,<?php echo $row['pid'] ?>)" method="post" class="form<?php $row['pid'] ?>">
								<input type="number" name="pro-id" value="<?php echo $row['pid'] ?>" hidden>
								<input type="number" name="pro-price" value="<?php echo $row['pro_discount_price'] ?>" hidden>
								<input type="text" name="action" value="increase" hidden>
								<button class="row-btn" name="submit" value="submit">Add to Cart</button>
							</form>

							<div class="prices">
								<p>₹ <?php echo $row['pro_price'] ?></p>
								<p>₹<?php echo $row['pro_discount_price'] ?></p>
								<p>(<?php echo $discount ?>% off)</p>
							</div>
						</div>
					</div>
				</div>
			</div>

	<?php
		}
	} else {
		echo "<h2>No Items were found </h2>";
	}

	?>


	</div>
</section>
<?php
include("utils/footer.php");
?>
</body>
<script src="./utils/colors.js" defer></script>

</html>