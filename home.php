<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_GET['q'])) {
	if ($_GET['q']=="") {

		header("Location:home.php");
	}
	
}
include('./utils/connect.php');
// function prevent($data){

// }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/home.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="utils/colors.css">

	<title>Home</title>
	
</head>

<body>
	<?php include("./navbar.php") ?>
	<?php


	function top_part()
	{
	?>
		<section class="home">
			<div class="home-text">
				<h4>In this season find the best</h4>
				<h1>Exclusive collection for everyone</h1>
				<a href="#feature" class="btn">Explore Now</a>
			</div>
			<div class="home-img">
				<img style="border-radius: 40px;" src="images/martin-sanchez-G78c3DPmD_A-unsplash.jpg" alt="Hero image">
			</div>
		</section>
	<?php
	}
	if (!isset($_GET['q'])) {
		top_part();
	}
	?>
	<section class="feature" id='products'>
		<div class="middle-text" id="feature">
			<h2>
				Discover More <span>Good things.....</span>
			</h2>
		</div>
		<?php
		if (isset($_GET['q'])) {
			$word = $_GET['q'];
			$word = htmlspecialchars(strtolower($word));
			echo "<p>Search results for '" . $word . "'</p>";
			echo "<script>
            document.querySelector('.search-bar').value='$word';
        </script>";
		}

		if (isset($_GET['q'])) {


			/// if searched for anything then display this 
			
			echo "<div class='feature-content'>";
			$sql = "select * from products where pro_type='$word' or pro_brand='$word' or pro_name = '$word' OR pro_name LIKE '%$word%'";
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
		} else {
			echo "<div class='feature-content'>";
			$sql = "select * from products ORDER BY RAND()";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					//echo "<br>id = " . $row['pid'];
					$discount =  (($row['pro_price'] - $row['pro_discount_price']) / $row['pro_price']) * 100;
					$rating = random_int(10, 50) / 10;
					$id = $row['pid'];
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
										<p>₹ <?php echo $row['pro_discount_price'] ?></p>
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
		}
		?>


		</div>
	</section>
	<section class="product">
		<div class="sections222">
			<div class="between-middle">
				<div class="middle-text">
					<h2>
						New Arrivals <span>Best selling of the Month </span>
					</h2>
				</div>
				<div class="product-content">


					<?php

					$favourite_sql = "SELECT *  FROM products ORDER BY RAND() LIMIT 3";
					$favourite_result = mysqli_query($conn, $favourite_sql);
					while ($row = mysqli_fetch_assoc($favourite_result)) {


					?>
						<div class="box">
							<div class="box-img">
								<img src="./product-images/<?php echo $row['pro_src'] ?>" onclick="location.href='product.php?item=<?php echo $row['pid'] ?>'" alt="Image here">
							</div>
							<h3><?php echo $row['pro_simple_name'] ?>...</h3>
							<h4>By <?php echo $row['pro_brand'] ?></h4>
							<div class="inbox">
								<div>
									<a href="" class="price">₹ <?php echo $row['pro_discount_price'] ?></a>
								</div>
							</div>
							<div class="rating">
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
							</div>
							<div class="heart">
								<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill"
										viewBox="0 0 16 16">
										<path
											d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
									</svg></i>
							</div>
						</div>
					<?php
					}
					?>


				</div>
			</div>
			<div class="between-middle">
				<div class="middle-text">
					<h2>
						Peoples Choice<span> Best Buying of the month </span>
					</h2>
				</div>
				<div class="product-content">


					<?php

					$favourite_sql = "SELECT *  FROM products ORDER BY RAND() LIMIT 3";
					$favourite_result = mysqli_query($conn, $favourite_sql);
					while ($row = mysqli_fetch_assoc($favourite_result)) {


					?>
						<div class="box">
							<div class="box-img">
								<img src="./product-images/<?php echo $row['pro_src'] ?>" onclick="location.href='product.php?item=<?php echo $row['pid'] ?>'" alt="Image here">
							</div>
							<h3><?php echo $row['pro_simple_name'] ?>...</h3>
							<h4>By <?php echo $row['pro_brand'] ?></h4>
							<div class="inbox">
								<div>
									<a href="" class="price">₹ <?php echo $row['pro_discount_price'] ?></a>
								</div>
							</div>
							<div class="rating">
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
							</div>
							<div class="heart">
								<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill"
										viewBox="0 0 16 16">
										<path
											d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
									</svg></i>
							</div>
						</div>
					<?php
					}
					?>


				</div>
			</div>
			<div class="between-middle">
				<div class="middle-text">
					<h2>
						Best Offers in here <span>Best Items of the Year </span>
					</h2>
				</div>
				<div class="product-content">


					<?php

					$favourite_sql = "SELECT *  FROM products ORDER BY RAND() LIMIT 3";
					$favourite_result = mysqli_query($conn, $favourite_sql);
					while ($row = mysqli_fetch_assoc($favourite_result)) {


					?>
						<div class="box">
							<div class="box-img">
								<img src="./product-images/<?php echo $row['pro_src'] ?>" onclick="location.href='product.php?item=<?php echo $row['pid'] ?>'" alt="Image here">
							</div>
							<h3><?php echo $row['pro_simple_name'] ?>...</h3>
							<h4>By <?php echo $row['pro_brand'] ?></h4>
							<div class="inbox">
								<div>
									<a href="" class="price">₹ <?php echo $row['pro_discount_price'] ?></a>
								</div>
							</div>
							<div class="rating">
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
								<a href=""><i><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											<path
												d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
										</svg></i></a>
							</div>
							<div class="heart">
								<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill"
										viewBox="0 0 16 16">
										<path
											d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
									</svg></i>
							</div>
						</div>
					<?php
					}
					?>


				</div>
			</div>
		</div>
	</section>

	<section class="cta-content">
		<div class="cta">
			<div class="cta-text">
				<a href="" class="logo"><img src="images/1logo.png" alt=""></a>
				<h3>Special offer in Wireless Items</h3>
				<p>Fashion is a form of self-expression and autonomy at a particular period and place</p>
				<a href="#feature" class="btn">Discover More</a>
			</div>
		</div>
	</section>

	<?php
	include("utils/footer.php");
	?>


</body>
<script src="./utils/colors.js" defer></script>

</html>