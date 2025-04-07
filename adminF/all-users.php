<?php

include('../utils/admin-checker.php');
include('../utils/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../utils/colors.css ">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="../styles/home.css">
	<title>All Users</title>
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

		.users {
			border: 1px solid grey;
			border-radius: 10px;
			padding: 10px;
			transition: .8s ease;
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;

		}

		.person {
			visibility: visible;
			display: flex;
			align-items: center;
			justify-content: center;
			opacity: 1;
			transition: .45s ease;

		}

		.person.search {
			visibility: hidden;
			opacity: 0;
		}

		.person.remove {
			display: none;
		}

		.users:hover {
			border-color: var(--high-accent);
		}

		.user {
			min-width: 400px;
			border: 1px solid transparent;
			margin: 10px;
			padding: 10px;
			border-radius: 9px;
			transition: all .45s ease;
		}

		.user:hover {
			border-color: var(--high-theme);
			transform: translateX(10px);
		}

		span {
			color: #000;
			margin: 5px 0;
			display: block;
		}

		.title {
			display: inline-block;
			margin-right: 8px;
		}

		.shadow-hover {
			transition: all linear 600ms;
			padding: 1px;
			border-radius: 8px;
		}

		.shadow-hover:hover {

			transition: all linear 600ms;
			box-shadow: 12px 12px 12px var(--low-theme), -10px -10px 10px rgba(0, 0, 0, 0.1);
		}

		.role {
			display: inline;
			padding: 7px;
			border-radius: 9px;
		}

		#input,
		#option-select {
			height: 35px;
			margin: 10px;
			outline: none;
			border: 1px solid var(--low-theme);
			border-radius: 9px;
			padding: 7px;

			&:active {
				border-color: var(--high-theme);
			}

			&:focus {
				border-color: var(--high-theme);
			}
		}

		.user-id,
		.user-name,
		.user-email {
			display: inline;
			color: #000;
		}


		@keyframes bounce-in-top {
			0% {
				-webkit-transform: translateY(-500px);
				transform: translateY(-500px);
				-webkit-animation-timing-function: ease-in;
				animation-timing-function: ease-in;
				opacity: 0;
			}

			38% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				-webkit-animation-timing-function: ease-out;
				animation-timing-function: ease-out;
				opacity: 1;
			}

			55% {
				-webkit-transform: translateY(-65px);
				transform: translateY(-65px);
				-webkit-animation-timing-function: ease-in;
				animation-timing-function: ease-in;
			}

			72% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				-webkit-animation-timing-function: ease-out;
				animation-timing-function: ease-out;
			}

			81% {
				-webkit-transform: translateY(-28px);
				transform: translateY(-28px);
				-webkit-animation-timing-function: ease-in;
				animation-timing-function: ease-in;
			}

			90% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				-webkit-animation-timing-function: ease-out;
				animation-timing-function: ease-out;
			}

			95% {
				-webkit-transform: translateY(-8px);
				transform: translateY(-8px);
				-webkit-animation-timing-function: ease-in;
				animation-timing-function: ease-in;
			}

			100% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				-webkit-animation-timing-function: ease-out;
				animation-timing-function: ease-out;
			}
		}

		.bounce-in-top {
			-webkit-animation: bounce-in-top 1.1s both;
			animation: bounce-in-top var(--t) both;
			transition: all .45s ease;
		}
	</style>
</head>
<?php
$select_query = "select * from users";
$select_results = mysqli_query($conn, $select_query);
?>

<body>
	<?php include('./admin-nav.php') ?>

	<div class="container">
		<div class="content">
			<h2>All Users </h2>
			<input onkeyup="findUser(event)" style="--t:2.4s" id="input" type="text" class="bounce-in-top" placeholder="Search for Users!!!!!!">
			<select name="" style="--t:2.9s" class="bounce-in-top" onchange="clearInput()" id="option-select">
				<option selected value="1">Search by Uid</option>
				<option value="2">Name</option>
				<option value="3">Email</option>
				<option value="4">Role</option>
			</select>
			<div class="users ">
				<?php
				$i = 1;
				while ($row = mysqli_fetch_assoc($select_results)) {

				?>
					<div class="person shadow-hover">
						<div style="--t:<?php echo random_int(10, 70) / 10 ?>s" class="number bounce-in-top">

							<span style="display: inline;" class=""><?php echo $i; ?></span>
						</div>
						<div style="--t:<?php echo random_int(10, 20) / 10 ?>s" class="user bounce-in-top">

							<span>
								<div class="title ">
									Uid :
								</div> <span class="user-id"><?php echo $row['uid']; ?></span>
							</span>
							<span>
								<div class="title ">
									Name:
								</div><span class=" user-name"><?php echo $row['name']; ?></span>
							</span>
							<span>
								<div class="title ">
									Email:
								</div><span class="user-email"><?php echo $row['email']; ?></span>
							</span>
							<span>
								<div class="title ">
									Role:
								</div>
								<div class="role"><?php echo $row['role']; ?></div>
							</span>
						</div>
					</div>

				<?php
					$i++;
				}
				?>
			</div>
		</div>
	</div>
	<script src="../utils/colors.js" defer></script>
	<script>
		let searchOption = document.getElementById('option-select');
		let userIdSpan = document.querySelectorAll(".user-id");
		let roleData = document.querySelectorAll('.role')
		let userNameSpan = document.querySelectorAll(".user-name")
		let userEmailSpan = document.querySelectorAll(".user-email")
		//console.log(roleData);


		roleData.forEach(data => {
			//console.log(data);
			if (data.innerHTML == "admin") {
				data.style.border = "1px solid red"
			}
		});

		function hideDiv(object, word) {
			//console.log("Recived object ", object);

			object.forEach((Element) => {
				//console.log(Element);
				Element.parentElement.parentElement.classList.remove("bounce-in-top")
				if (Element.innerHTML.toLowerCase().indexOf(word) > -1) {
					//Element.parentElement.parentElement.parentElement.style.display = "flex"
					Element.parentElement.parentElement.parentElement.classList.remove('remove')

					setTimeout(() => {
						//console.log("diaplay");

						Element.parentElement.parentElement.parentElement.classList.remove('search')
					}, 800)
				} else {
					//Element.parentElement.parentElement.parentElement.style.display = "none"
					Element.parentElement.parentElement.parentElement.classList.add('search')

					setTimeout(() => {
						//console.log("diaplay");

						Element.parentElement.parentElement.parentElement.classList.add('remove')
					}, 1200)

				}
				//console.log(Element.parentElement.parentElement.parentElement);
				//Element.style.display = "none"
			})
		}

		function findUser(e) {


			let word = e.target.value + "".toLowerCase()
			console.log(searchOption.value);
			//console.log(userIdSpan);

			if (searchOption.value == 1) {
				hideDiv(userIdSpan, word)
			} else if (searchOption.value == 2) {
				hideDiv(userNameSpan, word)
			} else if (searchOption.value == 3) {
				hideDiv(userEmailSpan, word)
			} else if (searchOption.value == 4) {
				hideDiv(roleData, word)
			}


		}

		function clearInput() {

			document.getElementById('input').value = "";
		}
		//console.log(typeof roleData);
	</script>
</body>

</html>