<!DOCTYPE html>
<html lang="en">

<?php
include('./utils/connect.php');
session_start();
if (!array_key_exists('user_name', $_SESSION) && empty($_SESSION['user_name'])) {
	header('Location: ./account/login.html');
}
$user = $_SESSION['user_id'];
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	if (isset($_SESSION['user_address']['pin'])) {
		$pin = $_POST['pin'];
		$address = $_POST['address'];
		$mobile = $_POST['mobile'];
	}


	$insert_sql = "update users set name = '$name'  ,email = '$email' where uid = $user";
	//echo $insert_sql;
	if (mysqli_query($conn, $insert_sql)) {
		$_SESSION['user_name'] = $name;
		$_SESSION['user_email'] = $email;

		if (isset($_SESSION['user_address']['pin'])) {
			$_SESSION['user_address'] = [
				'location' => $address,
				"pin" => $pin,
				"mobile" => $mobile,
			];
			$insert2 = "update shopping_orders set pincode = '$pin', address = '$address', mobile= $mobile where user_id = $user";
			if (mysqli_query($conn, $insert2)) {
				echo "<script>alert('User data updated successfully')</script>";
			}
		} else {
			echo "<script>alert('User data updated successfully')</script>";
		}
	}
}


$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];

if (isset($_SESSION['user_address'])) {
} else {
	$find = "select * from shopping_orders where user_id = $user";
	$find_result = mysqli_query($conn, $find);
	if (mysqli_num_rows($find_result) > 0) {
		while ($row = mysqli_fetch_assoc($find_result)) {
			$_SESSION['user_address'] = [
				'location' => $row['address'],
				"pin" => $row['pincode'],
				"mobile" => $row['mobile'],
			];
			break;
		}
	}
}

?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User</title>
	<link rel="stylesheet" href="./utils/colors.css">
	<link rel="stylesheet" href="./styles/my-oders.css">
	<link rel="stylesheet" href="./styles/home.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<style>
		* {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;

		}

		body {
			background: linear-gradient(to right, #b1cffa, var(--high-theme));
			font-family: "Raleway", sans-serif;
			height: 100vh;
		}

		.center {

			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);

		}

		.center .show-login {
			padding: 10px 20px;
			width: 94px;
			font-size: 15px;
			font-weight: 600;
			color: #222;
			background: #f5f5f5;
			border: none;
			outline: none;
			cursor: pointer;
			border-radius: 5px;


		}

		.center .show-signup {
			padding: 10px 20px;

			font-size: 15px;
			font-weight: 600;
			color: #222;
			background: #f5f5f5;
			border: none;
			outline: none;
			cursor: pointer;
			border-radius: 5px;


		}

		.pop-up {

			position: absolute;
			top: -150%;
			left: 40%;
			opacity: 0;
			transform: translate(-50px, -70px) scale(1.25);
			width: 400px;
			padding: 20px 30px;
			background: #fff;
			box-shadow: 2px 2px 5px 5px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			transition: top 0ms ease-in-out 200ms,
				opacity 200ms ease-in-out 0ms,
				transform 200ms ease-in-out 0ms;

		}

		.pop-up.active {
			top: 33%;
			opacity: 1;
			transform: translate(-50px, -50px) scale(1);
			transition: top 0ms ease-in-out 0ms,
				opacity 200ms ease-in-out 0ms,
				transform 200ms ease-in-out 0ms;
		}

		.pop-up .close-btn {
			position: absolute;
			top: 10px;
			right: 10px;
			width: 15px;
			height: 15px;
			background: #888;
			color: #eee;
			text-align: center;
			line-height: 15px;
			border-radius: 15px;
			cursor: pointer;

		}

		.pop-up .form h2 {

			text-align: center;
			color: #222;
			margin: 10px 0px 20px;
			font-size: 25px;

		}

		.pop-up .form .form-element {
			margin: 15px 0;

		}

		.pop-up .form .form-element label {
			font-size: 14px;
			color: #222;
		}

		.pop-up .form .form-element input[type="text"],
		.pop-up .form .form-element input[type="password"] {
			margin-top: 15px;
			display: block;
			width: 100%;
			padding: 10px;
			outline: none;
			border: 1px solid #aaa;
			border-radius: 5px;


		}



		.pop-up .form .form-element button {
			width: 100%;
			height: 40px;
			border: none;
			outline: none;
			font-size: 16px;
			background: linear-gradient(to right, var(--low-accent), var(--high-theme));
			color: black;
			border-radius: 10px;
			cursor: pointer;
		}

		.pop-up .form .form-element a {
			display: block;
			text-align: 15px;
			font-size: 15px;
			color: #1a79ca;
			text-decoration: none;
			font-weight: 600;
		}

		.name,
		.email,
		.role {
			padding: 12px;

		}

		.data {
			border: 1px solid transparent;
			border-radius: 9px;
			padding: 16px;
			transition: all .45s ease;

			&:hover {
				border-color: var(--highest);
			}
		}

		.address {
			padding: 10px;
			margin: 8px;
			border: 1px solid transparent;
			border-radius: 9px;
			padding: 16px;
			transition: all .45s ease;

			h3 {
				margin: 7px;
			}

			&:hover {
				border-color: var(--highest);
			}


		}

		input {
			border: 1px solid transparent;

			&:active {
				border-color: var(--high-theme);
			}

			&:focus {
				border-color: var(--high-theme);
			}
		}
	</style>
</head>

<body>
	<?php include('./navbar.php') ?>

	<div class="center">

		<div class="data">
			<div class="name">
				<h2>Name: => <?php echo $user_name ?></h2>
			</div>
			<div class="email">
				<h2>Email: => <?php echo $user_email ?></h2>
			</div>
			<div class="role">
				<h2>Role: => <?php echo $user_role ?></h2>
			</div>

			<?php
			if (isset($_SESSION['user_address']['pin'])) {
			?>
				<div class="address">
					<div class="name">
						<h3>Location: => <?php echo $_SESSION['user_address']['location'] ?></h3>
						<h3>Pin: => <?php echo $_SESSION['user_address']['pin'] ?></h3>
						<h3>Mobile: => <?php echo $_SESSION['user_address']['mobile'] ?></h3>
					</div>
				</div>
			<?php
			} else {
				echo " <h3>No Address was Found</h3>";
			}
			?>
		</div>


		<button class="show-signup">
			Edit My Data
		</button>
	</div>
	<div class="pop-up">
		<div class="close-btn">&times;</div>
		<form class="form" method="post" action="user.php">
			<h2>Edit your data</h2>
			<div class="form-element">
				<label for="email">Email</label>
				<input type="text" id="email" name="email" placeholder="Enter email" value="<?php echo $user_email ?>">
			</div>

			<div class="form-element">

				<div class="form-element">
					<label for="email">User Name</label>
					<input type="text" id="name" name="name" value="<?php echo $user_name ?>" placeholder="Enter User Name">
				</div>
				<?php
				if (isset($_SESSION['user_address']['pin'])) {
				?>
					<style>
						.pop-up.active {
							top: 23%;
						}
					</style>
					<div class="form-element">
						<label for="email">User address</label>
						<input type="text" id="name" name="address" value="<?php echo $_SESSION['user_address']['location'] ?>" placeholder="Enter User Name">
					</div>
					<div class="form-element">
						<label for="email">User pincode</label>
						<input type="text" id="name" name="pin" value="<?php echo $_SESSION['user_address']['pin'] ?>" placeholder="Enter User Name">
					</div>
					<div class="form-element">
						<label for="email">User mobile</label>
						<input type="text" id="name" name="mobile" value="<?php echo $_SESSION['user_address']['mobile'] ?>" placeholder="Enter User Name">
					</div>

				<?php
				}
				?>
				<div class="form-element">
					<button type="submit" name="submit">Save Data</button>
				</div>

			</div>
		</form>
	</div>
	<script src="./utils/colors.js" defer></script>
	<script>
		document.querySelector(".show-signup").addEventListener("click", function() {
			document.querySelector(".pop-up").classList.add("active");
		});
		document.querySelector(".pop-up .close-btn").addEventListener("click", function() {
			document.querySelector(".pop-up").classList.remove("active");
		});
	</script>
</body>

</html>