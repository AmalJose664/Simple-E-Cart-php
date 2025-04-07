<?php
include('./utils/connect.php');
session_start();
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}
if (isset($_POST['submits'])) {




	$user = $_SESSION['user_id'];
	$check_cart = "select * from cart where user_id=$user";
	$result_cart = mysqli_query($conn, $check_cart);
	if (mysqli_num_rows($result_cart) == 0 && !empty($_POST['direct-buy'])) {
		die("Cart is empty Cannot order anything");
	}
	if(isset($_POST['direct-buy'])){
		$direct_buy=true;
		$received_item = $_POST['item'];
	}
	$location = $_POST['location'];
	$pin = $_POST['pincode'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$method = $_POST['payment-method'];
	$delivery = $_POST['delivery'];

	$_SESSION['user_address'] = [
		'location' => $location,
		"pin" => $pin,
		"mobile" => $mobile,

	];

	if ($delivery == "Normal") {
		$time_to_deliver = 7;
	} elseif ($delivery == "Express") {
		$time_to_deliver = 5;
	} elseif ($delivery == "Sameday") {
		$time_to_deliver = 2;
	} else {
	}





	$take_sql = "select sum(quantity) as quantity, sum(total_price) as total from cart where user_id = $user";
	if(isset($direct_buy) && $direct_buy){
		$take_sql = "select pro_discount_price, 1  as quantity from products where pid= $received_item";
	}
	$result = mysqli_query($conn, $take_sql);
	while ($row = mysqli_fetch_assoc($result)) {
		if(isset($_POST['direct-buy'])){
			$total_price = $row['pro_discount_price'];
		}else{
			$total_price = $row['total'];
		}
		$total_quantity = $row['quantity'];
		break;
	}
	function insertOrders($connnection)
	{
		global $user, $total_price, $total_quantity, $location, $pin, $mobile, $method, $delivery;
		$insert_sql = "INSERT INTO shopping_orders 
    (order_id, user_id, order_date, total_amount, status, payment_method, total_quantity, address, pincode, delivery_type, mobile) 
    VALUES (NULL, ?, NOW(), ?, 'placed', ?, ?, ?, ?, ?, ?)";

		// Prepare the statement
		$stmt = $connnection->prepare($insert_sql);

		// Bind the parameters
		$stmt->bind_param(
			"idsisisi",
			$user,          
			$total_price,  
			$method,        
			$total_quantity, 
			$location,      
			$pin,           
			$delivery,     
			$mobile         
		);

		// Execute the query
		if ($stmt->execute()) {
			$last_id = mysqli_insert_id($connnection);
			//echo "true";
			$find_sql = "select * from cart where user_id = $user";
			$find_result = mysqli_query($connnection, $find_sql);
			while ($row = mysqli_fetch_assoc($find_result)) {
				//echo "<h2 style='color:red'>".$row['item_id'].",".$row['user_id'].",".$row['price']."</h2>";
				$item = $row['item_id'];
				$item_quantity = $row['quantity'];
				//echo "<code>qunatity =================$item_quantity</code>";
				$new_query = "insert into order_items 
				(oit_id, order_id, user_id, item_id,quantity) values 
				(null, $last_id, $user, $item,$item_quantity)";
				if (mysqli_query($connnection, $new_query)) {
					//echo "<br>true";
					$update_stocks = "update products set pro_stocks = pro_stocks-$item_quantity where pid = $item ";
					if (mysqli_query($connnection, $update_stocks)) {
						//echo "<h1>STocks updated succeful</h1>";
					} else {
						echo "<h1>STocks not  updated</h1>";
						return;
					}
				} else {
					echo "<br> fasle";
					return;
				}
			}
			if (clearCart($connnection, $user)) {
			} else {
				echo "Cart was not clearred";
			}
			displayPage($connnection, $last_id);
			//echo "=======$last_id<br>$new_query";
		} else {
			echo "Operation failed";
		}
	}



	
	function direct_buy_function($connnection){
		global $user, $total_price, $total_quantity, $location, $pin, $mobile, $method, $delivery, $received_item;
		$insert_sql = "INSERT INTO shopping_orders 
    (order_id, user_id, order_date, total_amount, status, payment_method, total_quantity, address, pincode, delivery_type, mobile) 
    VALUES (NULL, ?, NOW(), ?, 'placed', ?, ?, ?, ?, ?, ?)";

		// Prepare the statement
		$stmt = $connnection->prepare($insert_sql);

		// Bind the parameters
		$stmt->bind_param(
			"idsisisi",
			$user,         
			$total_price,   
			$method,       
			$total_quantity, 
			$location,      
			$pin,         
			$delivery,      
			$mobile       
		);

		// Execute the query
		if ($stmt->execute()) {
			$last_id = mysqli_insert_id($connnection);
			//echo "true";
			$find_sql = "select pid from products where pid = $received_item";
			$find_result = mysqli_query($connnection, $find_sql);
			while ($row = mysqli_fetch_assoc($find_result)) {
				//echo "<h2 style='color:red'>".$row['item_id'].",".$row['user_id'].",".$row['price']."</h2>";
				$item = $row['pid'];
				$item_quantity = 1;
				//echo "<code>qunatity =================$item_quantity</code>";
				$new_query = "insert into order_items 
				(oit_id, order_id, user_id, item_id,quantity) values 
				(null, $last_id, $user, $item,$item_quantity)";
				if (mysqli_query($connnection, $new_query)) {
					//echo "<br>true";
					$update_stocks = "update products set pro_stocks = pro_stocks-$item_quantity where pid = $item ";
					if (mysqli_query($connnection, $update_stocks)) {
						//echo "<h1>STocks updated succeful</h1>";
					} else {
						echo "<h1>STocks not  updated</h1>";
						return;
					}
				} else {
					echo "<br> fasle";
					return;
				}
			}
			
			displayPage($connnection, $last_id);
			//echo "=======$last_id<br>$new_query";
		} else {
			echo "Operation failed";
		}
	}


	if(isset($direct_buy) && $direct_buy){
		direct_buy_function($conn);
	}else{
		insertOrders($conn);
	}
	
} else {

	echo "Invalid request mode";
}


function displayPage($connection, $last_id)
{
	global $time_to_deliver;
	$order_sql = "select * , DATE_ADD(NOW(), INTERVAL $time_to_deliver  DAY) AS new_date from shopping_orders where order_id=$last_id";
	$order_result = mysqli_query($connection, $order_sql);

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./utils/colors.css">
		<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
		<link rel="stylesheet" href="./styles/order.css">
		<title>Thanks</title>
	</head>

	<body>
		<div class="order-container">
			<div class="box">
				<div class="title">
					Thanks for your Order
				</div>
				<div class="content">
					<div class="preset">
						<?php
						while ($row = mysqli_fetch_assoc($order_result)) {
							echo "<p>Order Number: " . $row['order_id'] . "</p>";
							echo "<p>Order Total: " . $row['total_amount'] . " </p>";
							echo "<p>Quantity Ordered: " . $row['total_quantity'] . " </p>";
							echo "<p>Ordered On: " . $row['order_date'] . "</p>";
							echo "<p>Payment Method: " . $row['payment_method'] . "</p>";

							echo "<p>Delivered by: " . $row['delivery_type'] . "</p>";
							echo "<p>Delivered by: " . $row['new_date'] . "</p>";
							echo "<p>Delivered To: " . $row['address'] . "</p>";
						}


						?>
						<a href="./my-orders.php">View My Orders</a>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="./utils/colors.js" defer></script>

	</html>
<?php
}

function clearCart($connnection, $user)
{
	$clear_sql = "delete  from cart where user_id = $user";
	if (mysqli_query($connnection, $clear_sql)) {
		return true;
	}

	return false;
}

?>