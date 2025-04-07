<?php
include('./utils/connect.php');
session_start();
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}
$user = $_SESSION['user_id'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Items</title>
	<link rel="stylesheet" href="./utils/colors.css">
	<link rel="stylesheet" href="./styles/home.css">
	<link rel="stylesheet" href="./styles/order-items.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
</head>
<?php
if (!isset($_GET['id'])) {
	echo "
<h2>No id was given</h2>";
	exit(0);
}
$id = $_GET['id'];
$order_query = "select * from order_items inner join products on order_items.item_id=products.pid  where order_id = $id";
$order_results = mysqli_query($conn, $order_query);


?>

<body>
	<?php include("./navbar.php") ?>
	<div class="container">
		<div class="content shadow-hover">
			<code>Order Number <?php echo $id ?></code>
			<div class="box">

				<?php
				if (mysqli_num_rows($order_results) > 0) {
					while ($order_row = mysqli_fetch_assoc($order_results)) {
				?>

						<div class="item">
							<div class="image-box" onclick="location.href='product.php?item=<?php echo $order_row['pid'] ?>'">
								<img src="./product-images/<?php echo $order_row['pro_src'] ?>" alt="We think this product has been deleted">
							</div>
							<div class="product">
								<div class="title">
									<h3>Item name: <?php echo $order_row['pro_simple_name'] ?>...</h3>
									<h3>Item Price: <?php echo $order_row['pro_discount_price'] ?></h3>
									<h4 style="margin-top: 8px;">Quantity Ordered: <?php echo $order_row['quantity'] ?></h4>
								</div>
							</div>
						</div>

				<?php
					}
				} else {
					echo
					"<h2>No Product was found</h2><br><h5>This can be due to the product may be deleted from database</h5>";
					echo $id;
				}
				?>


			</div>
		</div>
	</div>
</body>
<script src="./utils/colors.js" defer></script>

</html>