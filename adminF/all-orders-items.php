<?php

include('../utils/admin-checker.php');
include('../utils/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Items Admins</title>
	<link rel="stylesheet" href="../utils/colors.css ">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="../styles/home.css">
	<style>
		* {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
			font-family: Arial, Helvetica, sans-serif;
			list-style: none;

			a {
				text-decoration: none;
			}
		}

		html {
			scroll-behavior: smooth;
		}

		.container {
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
			margin: 10px;
			margin-top: 90px;
		}

		.content {
			padding: 15px;
			margin: 10px;

		}

		.box-56 {
			border: 1px solid transparent;
			display: flex;
			text-align: center;
			border-radius: 8px;
			flex-direction: column;
			gap: 20px;
			width: 1200px;
			background-color: #efefef;
			padding: 10px;
			transition: all .7s ease;

			.box2 {
				display: flex;
				flex-direction: row;
				width: 100%;

			}
		}

		.shadow-hover {
			transition: all linear 600ms;
			padding: 1px;
			border-radius: 8px;
		}

		.shadow-hover:hover {

			transition: all linear 600ms;
			box-shadow: 12px 12px 12px rgba(0, 0, 0, 0.1), -10px -10px 10px #ffffff;
		}

		.box-56:hover {
			background-color: #fbfbfb;
			border-color: var(--high-theme);

		}

		.section1 {
			border-radius: 8px;
			display: flex;
			padding: 60px;
			text-align: left;
			flex-direction: column;
			width: 40%;
			border: 1px solid var(--high-theme);

			p {
				margin-left: 10px;
				margin: 6px 0;
			}

			h4 {
				margin: 6px 0;
			}
		}

		.delivery p,
		.delivery h4 {
			margin: 8px;
		}

		.delivery,
		.payment {
			border: 1px solid transparent;
			margin: 4px 0;
			border-radius: 8px;
			padding: 6px;
			transition: .45s ease;

		}

		.delivery,
		.payment {
			&:hover {
				border-color: var(--highest);
			}
		}

		.section1:hover {
			border-color: var(--highest);
		}

		code {
			font-family: 'Courier New', Courier, monospace;
			color: var(--highest);
		}

		.section2::-webkit-scrollbar {
			width: 10px;
		}

		.section2 {

			border-radius: 8px;
			padding: 30px;
			align-items: center;
			height: 800px;
			overflow-y: scroll;
			width: 60%;
		}

		.items-9090 {
			border-radius: 8px;
			display: flex;
			flex-direction: column;

			img {
				border-radius: 8px;
				height: 140px;
				width: auto;
			}

		}

		.in-items {
			padding: 6px;
			border-radius: 8px;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			gap: 80px;
			margin: 30px 0;
			border: 1px solid rgb(210, 210, 210);

			div {
				border-radius: 8px;
				display: flex;
				flex-direction: column;
				text-align: left;

			}
		}
	</style>
</head>
<?php
if (!isset($_GET['id'])) {
	exit(0);
}
$id = $_GET['id'];
$select_query = "select * from order_items inner join users on order_items.user_id = users.uid INNER join shopping_orders on shopping_orders.order_id=order_items.order_id where shopping_orders.order_id = $id";
$select_results = mysqli_query($conn, $select_query);
$order_sql = "select * from order_items inner join products on products.pid = order_items.item_id where order_id = $id";
$order_results = mysqli_query($conn, $order_sql);
?>

<body>
	<?php include('./admin-nav.php') ?>
	<div class="container">
		<div class="content">
			<div class="box-56">
				<h3>Order Id <code><?php echo $id ?></code> details</h3>

				<div class="box2">
					<div class="section1 shadow-hover">
						<?php
						while ($row = mysqli_fetch_assoc($select_results)) {


						?>
							<h2>User Details</h2>
							<p>Name : <?php echo $row['name'] ?></p>
							<p>Email : <?php echo $row['email'] ?></p>
							<details style="margin-bottom: 20px;">
								<p>User Id: <code><?php echo $row['uid'] ?></code></p>
							</details>
							<div class="delivery shadow-hover">
								<h4>Delivery Details</h4>
								<p>Mobile : <?php echo $row['mobile'] ?></p>
								<p>Address :<?php echo $row['address'] ?></p>
								<p>PinCode : <?php echo $row['pincode'] ?></p>
								<p>Delivery Method : <?php echo $row['delivery_type'] ?></p>
							</div>

							<div class="payment shadow-hover">
								<h4>Payment Details</h4>
								<p>Ordered Date : <?php echo $row['order_date'] ?></p>
								<p>payment Method : <?php echo $row['payment_method'] ?></p>
								<p>Total Amount : <?php echo $row['total_amount'] ?></p>
								<p>Status : <?php echo $row['status'] ?></p>

							</div>
						<?php
							break;
						} ?>
						<a style="margin-top: 80px;" href="./all-orders.php">Back</a>
					</div>
					<div class="section2 shadow-hover">
						<div class="items-9090">
							<?php
							$j = 1;
							if (mysqli_num_rows($order_results) > 0) {
								while ($row = mysqli_fetch_assoc($order_results)) {


							?>

									<div class="in-items shadow-hover">
										<div>
											<h2>Item <?php echo $j ?></h2>
											<p>Name : <?php echo $row['pro_simple_name'] ?></p>
											<p>Type : <?php echo $row['pro_type'] ?></p>
											<p>Price : <?php echo $row['pro_price'] ?></p>
											<p>Quantity :<?php echo $row['quantity'] ?></p>

										</div>
										<img src="../product-images/<?php echo $row['pro_src'] ?>" alt="Image">
									</div>
							<?php
									$j++;
								}
							} else {
								echo "<h3>We think the Item has been deleted from our Database<br>Cant show Item image</h3>";
							}
							?>


						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<script src="../utils/colors.js" defer></script>
</body>

</html>