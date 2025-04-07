<?php 
session_start();

include('./utils/connect.php');
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/images/E-cart-logo.jpg" type="image/x-icon">
	<title>Cart Functions</title>
</head>
<body>
	
</body>
</html>
<?php
if(isset($_POST['submit'])){
	$pro_id = $_POST['pro-id'];
	$pro_price = $_POST['pro-price'];
	$pro_action= $_POST['action'];
	
	$user = $_SESSION['user_id'];


	
	// echo $pro_id."====Product id<br>";
	// echo $pro_price . "====Product price<br>";
	// echo $pro_action . " ====Product action<br>";
	// echo $user . "<br>";



	function delete_product($connection){
		echo "<h2 style='color: red; font-family:sans-serif'>Delete function</h2>";
		global $pro_id,$user;
		$sql = "delete  from cart where item_id=$pro_id and user_id = $user";
		if(mysqli_query($connection,$sql)){
			echo "<h2 style='color: red; font-family:sans-serif'>Product Delete Successfull (quantity DELETED)</h2>";
			header("Location: cart.php");
			return;
		}
		echo "<h2 style='color: red; font-family:sans-serif'>Product Delete Unsuccessfull </h2>";
		


	}

	function decrease_product($connection) {
		echo "<h2 style='color: red; font-family:sans-serif'>Decrease function</h2>";
		global $pro_id, $user ;
		$sql = "select quantity,total_price from cart where item_id=$pro_id and user_id = $user";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) != 1) {
			return;

		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<h2>" . $row['quantity'] . "</h2>";
			$quantity = $row['quantity'];
			$item_total = $row['total_price'];
		}
		if($quantity==1){
			$remove_sql="delete from cart where item_id=$pro_id and user_id = $user";
			if (mysqli_query($connection, $remove_sql)) {

				$link = "Location: cart.php#item$pro_id";
				echo "<br><br><br>Removed  product success (quantity decreased)<br><br><br>";
				header($link);
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product insert Unsuccessfull</h2>";

		}elseif($quantity>1){
			$update_sql = "update cart set quantity= quantity-1, total_price = $item_total-price where user_id = $user and item_id = $pro_id";
			if (mysqli_query($connection, $update_sql)) {

				$link = "Location: ./cart.php#item$pro_id";
				header($link);
				echo "<h2 style='color: red; font-family:sans-serif'>Product Update Successfull (quantity decreased)</h2>";
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product Update UNsuccessfull</h2>";
			
		}



	}
	function increase_product($connection) {

		echo "<h2 style='color: red; font-family:sans-serif'>Increase function</h2>";
		global $pro_id, $user ,$pro_price;

		$stock_sql = "select pro_stocks from products where pid= $pro_id";
		$result= mysqli_query($connection,$stock_sql);
		while($row=mysqli_fetch_assoc($result)){
			if($row['pro_stocks']==0){
				echo $_SERVER['HTTP_REFERER']."  ==  ".$row['pro_stocks'];
				$link = "Location: ".$_SERVER['HTTP_REFERER']."?Availability=0";
				header($link);
				return;
			}
		}

		$quantity = 1;
		$total_price = $pro_price * $quantity;

		$sql = "select * from cart where item_id=$pro_id and user_id = $user";
		$result = mysqli_query($connection, $sql);

		if(mysqli_num_rows($result)==0){
			
			$insert_sql = "insert into cart (cart_id, user_id, item_id, quantity, price, total_price ) values (null,$user, $pro_id, $quantity, $pro_price, $total_price)";
			if(mysqli_query($connection,$insert_sql)){
				
				$link = "Location: ./home.php#item$pro_id";
				echo "<h2 style='color: red; font-family:sans-serif'>Product insert Successfull (quantity increased)</h2>";
				header($link);
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product insert UNSuccessfull</h2>";
			
			
		}else{

			$check_stock_sql = "SELECT pro_stocks from products where pid = $pro_id";
			
			$result = mysqli_query($connection,$check_stock_sql);
			while($row=mysqli_fetch_assoc($result)){
				if($_POST['quantity']>$row['pro_stocks']-1){
					echo $_POST['quantity'] . "|||".$row['pro_stocks'];
					echo "<h2 style='color: red; font-family:sans-serif'>Product Update UNSuccessfull </h2>";
					echo "<h1 style='color: red; font-family:sans-serif'>Quantity reached maximum stocks. Cant order more... </h1>";
					return;
				}
			}

			$update_sql= "update cart set quantity = quantity + 1 , total_price = price*(quantity) where user_id = $user and item_id = $pro_id";
			if (mysqli_query($connection, $update_sql)) {
				
				$link = "Location: ./cart.php#item$pro_id";
				header($link);
				
				echo "<h2 style='color: red; font-family:sans-serif'>Product Update Successfull (quantity increased)</h2>";
				return;
			}
			echo "<h2 style='color: red; font-family:sans-serif'>Product Update UNSuccessfull </h2>";
			
		}

	}
	



	if ($pro_action == "delete") {
		echo "Delete query";
		delete_product($conn);

	} 
	
	elseif ($pro_action == "increase") {
		echo "Increase query";
		 increase_product($conn);
	} 
	
	elseif ($pro_action == "decrease") {
		echo "decrease query";
		 decrease_product($conn);
	}
	
	else{
		die("Invalid Function");
	}
	echo "<h2 style='color: red; font-family:sans-serif'><a href='cart.php'>Click here to go to Cart.php</a></h2>";

}
?>