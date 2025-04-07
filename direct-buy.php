<?php
include('./utils/connect.php');
session_start();
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}
$user = $_SESSION['user_id'];
if (!isset($_POST['direct-buy'])) {
	echo "Some data not received";
	$direct_buy = false;
	exit(0);
}
$direct_buy = true;
$item = $_POST['item'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./utils/colors.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="./styles/place-order.css">
	<link rel="stylesheet" href="./styles/home.css">
	<title>Direct Buy</title>
	<script>
		cartEmpty = false
	</script>
</head>

<body>
	<?php include("./navbar.php") ?>


	<div class="place-container">
		<div class="place-small-container">
			<div class="adrress-area shadow-hover">
				<form id="document-form" class="content" action="orders.php" method="post">
					<div class="title">
						<h2>Checkout</h2>
						<p>A checkout is a counter where you pay for things you are buying </p>
					</div>


					<div class="contact">
						<div class="contact-title">
							1) Contact Information
						</div>
						<contact class="boxes">
							<div class="input">
								<input type="text" required placeholder="" name="name" id="name" max="16">
								<label for="">Name </label>

							</div>
							<div class="input">
								<input type="tel" required placeholder="" name="mobile" maxlength="10" pattern="[0-9]{10}" min='9' id="mobile">
								<label for="">Phone Number</label>

							</div>
							<div class="input">
								<input type="email" required placeholder="" id="email" name="email">
								<label for="">Email</label>

							</div>
							<div class="input">
								<input type="text" required placeholder="" name="location" id="location" max="20">
								<label for="">Location</label>

							</div>

						</contact>
					</div>

					<div class="delivery">
						<div class="delivery-title">
							2) Delivery Method
						</div>
						<div class="delivery-boxes">
							<label for="same-day" class="radio-box">
								<input required type="radio" id="same-day" name="delivery" class="radio" value="Sameday">
								<span class="radio-span">Same Day</span>
							</label>
							<label for="express" class="radio-box">
								<input required type="radio" id="express" name="delivery" class="radio" value="Express">
								<span class="radio-span">Express</span>
							</label>
							<label for="normal" class="radio-box">
								<input required type="radio" id="normal" name="delivery" class="radio" value="Normal">
								<span class="radio-span">Normal</span>
							</label>
							<div class="input">
								<input type="number" required placeholder="" min='100000' max="999999" name="pincode" id="pin">
								<label for="">PINCODE</label>

							</div>

						</div>
					</div>

					<div class="payment">
						<div class="payment-title">
							3) Payment Method
						</div>
						<div class="payment-boxes">
							<label onclick="inputChange(true)" for="online" class="payment-radio">
								<input required type="radio" id="online" name="payment-method" onclick="" class="payment-input" value="online">
								<span class="payment-span">Online</span>
							</label>
							<label for="cod" class="payment-radio">
								<input onclick="inputChange(false)" required type="radio" id="cod" name="payment-method" class="payment-input" value="cod">
								<span class="payment-span">COD</span>
							</label>

						</div>
					</div>
					<input required type="number" value="<?php echo $user ?>" hidden>
					<input type="number" value="<?php echo $item ?>" name="item" hidden>
					<input type="number" value="<?php echo 'direct-buy' ?>" name="direct-buy" hidden>
					<input required id='submit-btn-order' type="submit" value="submits" name="submits" hidden>
				</form>
			</div>


			<div class="place-summary">
				<div class="card">
					<div class="top">
						<div class="summary-title">
							Delivered To,<p style="margin-left: 10px; margin-top: 6px; " id="name-display">------ </p>
							<p id="location-display" style="margin-left: 10px; margin-top: 6px;">------</p>
							<p id="pin-display" style="margin-left: 10px;">-----</p>
						</div>
						<div class="card-content">




							<div class="total-items">
								<p>1 Item</p>
							</div>
							<div class="list">
								<?php

								$sql = "select pro_simple_name, pro_discount_price as price from products where pid = $item and pro_stocks>1";
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) == 0) {
									echo "<script>
								cartEmpty=true;
							</script>";
								}
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<div class='pro-name'>" . $row['pro_simple_name'] . "</div>" . "<div class='pro-name' style='padding-left:10px'>  (" . 1 . ")</div>" . "<div class='pro-name'>₹ " . $row['price'] . "</div>";
								}
								?>



							</div>
							<div class="total">
								<p>Total</p> <span class="money">
									<?php

									$next_sql = "select pro_discount_price as sum from products where  pid = $item";
									$next_result = mysqli_query($conn, $next_sql);
									while ($row = mysqli_fetch_assoc($next_result)) {
										echo  "₹ " . $row['sum'];
									}
									?>
								</span>
							</div>
							<div class="button">
								<button onclick="submitToOrder(this)">
									Proceed &#8702;
								</button>
							</div>
						</div>
						<a href="cart.php">Go to cart</a>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="online-payment-box ">
		<span class="close">&times;</span>
		<h2>Please Enter card details for Online Purchase</h2>
		<div class="content">
			<form class="inner-div" id="document-form2">
				Credit or Debit Card Number

				<div class="input">
					<input oninput="inputValidate(event,12)" type="text" required placeholder="" pattern="\d{12}" name="card" id="">
					<label for="">Card
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
							<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
						</svg>
					</label>


				</div>
				Expiration Date
				<div class="input">
					<input type="date" required placeholder="" min="<?php echo date('Y-m-d'); ?>" name="date" id="">
					<label for="">Expiry date

					</label>

				</div>
				Security Code
				<div class="input">

					<input type="text" oninput="inputValidate(event,3)" required placeholder="" pattern="\d{3}" name=" cvv" id="">
					<label for="">Cvv
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
							<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
						</svg>
					</label>

				</div>
				<div class="input">
					<input type="text" required placeholder="" min='100' max="999" name="cvv" id="">
					<label for="">Full Name on Card
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
							<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
						</svg>
					</label>

				</div>
				<input type="submit" onclick="submitToOrder()" hidden>

			</form>
		</div>
	</div>
</body>
<script src="./utils/colors.js" defer></script>
<script>
	let onlineSelected = false;


	const nameValue = document.getElementById('name-display');
	const nameBox = document.getElementById('name')
	const locationValue = document.getElementById('location-display');
	const locationBox = document.getElementById('location');
	const pinValue = document.getElementById('pin-display');
	const pinBox = document.getElementById('pin');


	const sbmBtn = document.getElementById('submit-btn-order');
	const onlineOrder = document.querySelector('.online-payment-box');
	let form1 = document.getElementById('document-form');
	let form2 = document.getElementById('document-form2');
	let closeBtn = document.querySelector('.close');


	nameBox.addEventListener('input', () => {
		nameValue.textContent = nameBox.value
	});

	locationBox.addEventListener('input', () => {
		locationValue.textContent = locationBox.value
	});
	pinBox.addEventListener('input', () => {
		pinValue.textContent = pinBox.value
	});

	//console.log(name, nameValue, locationValue, locationBox, pinBox, pinValue);
	let i = 0;
	let j = 0;
	//console.log(sbmBtn);
	const submitToOrder = (object) => {

		//console.log(form1.checkValidity());

		if (!form1.checkValidity()) {

			form1.reportValidity();
			i = i + 1;
			if (i > 4) {
				return alert("Please fill the neccesary Data");
			}
			console.log("return ed from here");

			return

		}
		if (cartEmpty) {
			return alert("Products not in stock Cannot buy item ");
		}
		if (onlineSelected) {
			onlineOrder.classList.add('show')
			//object.style.display="none";

		}
		if (!form2.checkValidity() && onlineSelected) {
			console.log("last part");
			form2.reportValidity();
			j = j + 1;
			if (j % 4 == 0) {
				return alert("Please fill the Online card data");
			}
			return
		}

		console.log("last part of form clicking");
		sbmBtn.click();
	}


	closeBtn.onclick = () => {
		onlineOrder.classList.remove('show')
	}

	function inputChange(condition) {
		onlineSelected = condition
		//console.log(onlineSelected);


	}

	function inputValidate(e, n) {
		const inputField = e.target;
		const value = inputField.value;


		inputField.value = value.replace(/\D/g, '').slice(0, n);
	}
</script>

</html>