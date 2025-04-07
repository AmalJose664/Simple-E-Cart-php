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
	<title>My Orders</title>
	<link rel="stylesheet" href="./utils/colors.css">
	<link rel="stylesheet" href="./styles/my-oders.css">
	<link rel="stylesheet" href="./styles/home.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">


</head>
<?php
$select_query = "select * from shopping_orders where user_id = $user";
$select_results = mysqli_query($conn, $select_query);


?>

<body>
	<?php include("./navbar.php") ?>
	<div class="container">
		<div class="content">
			<?php


			if (mysqli_num_rows($select_results) > 0) {


			?>
				<div class="title">
					<h2><?php echo $_SESSION['user_name'] ?>'s Orders</h2>
				</div>

				<div class="table">
					<table>
						<thead>

							<tr>
								<th>Order Id</th>
								<th>Order Date</th>
								<th>Amount Payed</th>
								<th>Status</th>
								<th>Payment Method</th>
								<th>Quantity Ordered</th>
								<th>PIN</th>
								<th>Address</th>
								<th>Delivery Type</th>
								<th>Phone</th>
								<th >View Items</th>


							</tr>
						</thead>

						<?php
						$arrival_time = 0;
						while ($select_row = mysqli_fetch_assoc($select_results)) {
							if ($select_row['delivery_type'] == "Normal") {
								$arrival_time = 7;
							} elseif ($select_row['delivery_type'] == "Express") {
								$arrival_time = 5;
							} elseif ($select_row['delivery_type'] == "Sameday") {
								$arrival_time = 2;
							} else {
							}
							$date = new DateTime($select_row['order_date']);
							$date->modify('+' . $arrival_time . ' days');

							$today_date = new DateTime(date('Y-m-d'));

							//$newDate = $date->format('Y-m-d');

							echo "<tr><td>" . $select_row['order_id'];
							if ($date > $today_date) {
								echo "<span style='color:red' class='tick'>&#10006;</span>";
							} else {
								echo "<span style='color:green' class='tick'>&#10004;</span>";
							}
							echo "</td>";
							echo "<td>" . $select_row['order_date'] . "</td>";
							echo "<td>₹ " . $select_row['total_amount'] . "</td>";
							if ($date > $today_date) {
								echo "<td style='background:var(--accent-color);border-radius:8px'>Order Placed</td>";
							} elseif ($date < $today_date) {
								echo "<td style='background:#4eebbb;border-radius:8px'>Placed and Arrived</td>";
							} else {
								echo "<td style='background:#7df493;border-radius:8px'>Arriving Today</td>";
							}
							//echo "<td>" . $select_row['status'] . "       dsfds" . "</td>";
							echo "<td>" . $select_row['payment_method'] . "</td>";
							echo "<td>" . $select_row['total_quantity'] . "</td>";
							echo "<td>" . $select_row['pincode'] . "</td>";
							echo "<td>" . $select_row['address'] . "</td>";
							echo "<td>" . $select_row['delivery_type'] . "</td>";
							echo "<td>" . $select_row['mobile'] . "</td>";
							//echo "$today_date";

						?>
							<td><button class="view-btn" onclick="location.href='order-items.php?id=<?php echo $select_row['order_id'] ?>'">view</button></td>
						<?php


						}

						?>

					</table>
				</div>

			<?php } else {
				echo "<h2>Looks like you have not purchased anything yet</h2><br><a href='home.php#feature'>Buy Items</a>";
			}
			?>
		</div>
	</div>
</body>
<script src="./utils/colors.js" defer></script>

</html>