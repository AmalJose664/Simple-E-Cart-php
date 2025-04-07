<?php

include('../utils/admin-checker.php');
include('../utils/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../utils/colors.css ">
	<link rel="stylesheet" href="../styles/home.css">
	<title>Admin - All Products</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f4f4f9;
			color: #333;
		}

		span {
			margin: 7px 0;
		}

		.container {
			max-width: 1200px;
			margin: 20px auto;
			padding: 20px;
			margin-top: 100px;
		}

		.page-title {
			text-align: center;
			margin-bottom: 20px;
		}

		.product-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			gap: 20px;
		}

		.product-card {
			background: #fff;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			padding: 15px;
			display: flex;
			flex-direction: column;
			gap: 10px;
			transition: transform 0.3s ease;
		}

		.product-card:hover {
			transform: translateY(-5px);
		}

		.product-image {
			width: 130px;
			height: auto;
			object-fit: cover;
			border-radius: 8px;
			background-color: #ddd;
		}

		.product-details {
			display: flex;
			flex-direction: column;
			gap: 5px;
		}

		.product-details span {
			font-size: 14px;
			color: #555;
		}

		.product-name {
			font-weight: bold;
			font-size: 18px;
			color: #222;
		}

		.price {
			font-size: 16px;
			color: #e63946;
		}

		.discount-price {
			font-size: 14px;
			color: #2a9d8f;
		}

		.btn-group {
			margin-top: auto;
			display: flex;
			gap: 10px;
		}

		.btn {
			padding: 10px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 14px;
		}

		.btn-edit {
			background: linear-gradient(to right, var(--high-theme), var(--highest)) !important;
			color: #fff;
		}

		.btn-delete {
			background: linear-gradient(to left, var(--high-theme), var(--highest)) !important;
			color: #fff;
		}
	</style>
</head>

<body>
	<?php include('./admin-nav.php') ?>
	<div class="container">
		<h1 class="page-title">Item page </h1>
		<div class="product-grid">
			<?php
			if (!isset($_GET['id'])) {
				echo "ID not received";
				exit();
			} else {
				//echo  "<<<<===========here row";
				$id = $_GET['id'];
				$select_query = "select * from products where pid = $id";
				//echo $select_query;
				$select_results = mysqli_query($conn, $select_query);
				while ($row = mysqli_fetch_assoc($select_results)) {


			?>
					<!-- Product Card Start -->
					<div class="product-card">
						<img src="../product-images/<?php echo $row['pro_src'] ?>" alt="Product Image" class="product-image">
						<div class="product-details">
							<span class="product-name"><?php echo $row['pro_name'] ?>.....</span>
							<span>Brand: <?php echo $row['pro_brand'] ?></span>
							<span>Type: <?php echo $row['pro_type'] ?></span>
							<span>Stocks: <?php echo $row['pro_stocks'] ?></span>
							<span class="price">Price: <?php echo $row['pro_price'] ?></span>
							<span class="discount-price">Discount Price: <?php echo $row['pro_discount_price'] ?></span>
							<span>Description: <?php echo $row['pro_description'] ?></span>
							<span>Added Date: <?php echo $row['added_date'] ?></span>
							<span>Item id <?php echo $row['pid'] ?></span>
						</div>
						<div class="btn-group">
							<button class="btn btn-edit">Edit</button>
							<button onclick="deleteProduct(<?php echo $row['pid'] ?>,'<?php echo $row['pro_simple_name'] ?>' )" class="btn btn-delete">Delete</button>
						</div>
					</div>
			<?php }
			} ?>
			<!-- Product Card End -->

			<!-- Duplicate and Modify Product Cards as Needed -->
		</div>
	</div>
	<div class="link-maker">

	</div>
	<script src="../utils/colors.js" defer></script>
	<script>
		let link = document.getElementsByClassName('link-maker')[0];
		console.log(link);

		deleteProduct = (id, name) => {
			if (confirm("Are you sure yuo want to delete '" + name + "'")) {
				//location.href='all-product.php?id='+id;
				let innerData = `<form action="all-product.php" method="post">
					<input type="number" hidden value="${id}" name = 'id'">
				</form>`
				link.innerHTML = innerData;
				document.forms[1].submit();


			}
		}
	</script>
</body>

</html>