<?php include("../utils/admin-checker.php");
include("../utils/connect.php");
?>
<?php
if (!isset($_POST['id'])) {
	echo "ID not received";
	//exit();
} else {
	//echo  "<<<<===========here row";
	$id = $_POST['id'];
	$select_query = "select * from products where pid = $id";
	//echo $select_query;
	$select_results = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($select_results)) {


?>

		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
			<link rel="stylesheet" href="./styles-admin/edit-items.css">
			<title>Add Items</title>
		</head>

		<body>
			<a style="float: right; color:#137aa9;" href="../adminF/">Go back</a>
			<div class="container">

				<form id=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" class="edit-item-form"
					enctype="multipart/form-data">
					<p style="color: red;" id="message">-</p>
					<div class="top shadow-hover">
						<h2>Edit Items in the Shop</h2>
						<input type="submit" name="submit" required value="Save Changes ">
					</div>
					<div class="outer shadow-hover">
						<div>Edit</div>
						<div class="box1 shadow-hover">
							<div class="inside-box">
								<p class="headings">Product Image</p>
								<div class="file-box ">
									<label id="file-name" for="file">Select Image</label>
									<img id="file-image" src="../product-images/<?php echo $row['pro_src'] ?>" alt="" height="100px">
									<input type="file" name="file" id="file" accept="image/*" required value="../product-images/<?php echo $row['pro_src'] ?>">
								</div>
								<h6 style="margin: 10px 0; color:#3f4040">Pay Attention to the image quality while uploading*
								</h6>
							</div>

							<div class="inside-box">
								<p>Numbers Section!!</p>
								<div class="l-details details">
									<div class="price">
										Price
										<input type="number" value="<?php echo $row['pro_price'] ?>" name="price" min="10" required
											placeholder="Price of Product" id="original-price" onkeyup="discountCalc()">
									</div>
								</div>
								<div class="l-details details">
									<div class="price">
										Discount in % (if Available)
										<input type="number" value="0" min="0" max="92" required placeholder="Discount in %"
											id="discount-value" onkeyup="discountCalc()" onchange="discountCalc()">

									</div>
								</div>
								<div class="l-details details">
									<div class="price">
										Final Price
										<input type="number" value="<?php echo $row['pro_price'] ?>" name="discount-price" id="discount-price" required
											placeholder="Discount Price" readonly>

									</div>
								</div>
							</div>

						</div>
						<div class="box2 shadow-hover">
							<div class="inside-box">
								<p class="headings">Product Type</p>
								<label class="radio-box">
									<input required <?php if ($row['pro_type'] == 'mobile') {
														echo 'checked';
													} ?> type="radio" class="radios" name="pro-Type" value="mobile"
										onclick="inputChange(1)">
									<span class="radio-span">
										<svg class="svg1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
											viewBox="0 0 120 120">
											<path
												d="M85.81 120H34.19a8.39 8.39 0 0 1-8.38-8.39V8.39A8.39 8.39 0 0 1 34.19 0h51.62a8.39 8.39 0 0 1 8.38 8.39v103.22a8.39 8.39 0 0 1-8.38 8.39zM34.19 3.87a4.52 4.52 0 0 0-4.51 4.52v103.22a4.52 4.52 0 0 0 4.51 4.52h51.62a4.52 4.52 0 0 0 4.51-4.52V8.39a4.52 4.52 0 0 0-4.51-4.52z" />
											<path
												d="M73.7 10.32H46.3L39.28 3.3 42.01.57l5.89 5.88h24.2L77.99.57l2.73 2.73-7.02 7.02zM47.1 103.23h25.81v3.87H47.1z" />
										</svg>
										Mobiles
									</span>
								</label>
								<label class="radio-box">
									<input required <?php if ($row['pro_type'] == 'laptop') {
														echo 'checked';
													} ?> type="radio" class="radios" name="pro-Type" value="laptop"
										onclick="inputChange(2)">
									<span class="radio-span">
										<svg class="svg2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
											xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											viewBox="0 0 122.88 70.51" style="enable-background:new 0 0 122.88 70.51"
											xml:space="preserve">
											<style type="text/css">
												.st0 {
													fill-rule: evenodd;
													clip-rule: evenodd;
												}
											</style>
											<g>
												<path class="st0"
													d="M2.54,65.44h12.59c-0.93-0.24-1.63-1.1-1.63-2.1V2.17C13.5,0.98,14.48,0,15.67,0h90.97 c1.19,0,2.17,0.98,2.17,2.17v61.16c0,1.01-0.69,1.86-1.63,2.1h13.16c1.4,0,2.54,1.14,2.54,2.54v0c0,1.4-1.14,2.54-2.54,2.54H2.54 c-1.4,0-2.54-1.14-2.54-2.54v0C0,66.58,1.14,65.44,2.54,65.44L2.54,65.44z M17.21,3.4h88.19v59.32H17.21V3.4L17.21,3.4z M57.87,66.39h7.14c0.67,0,1.22,0.55,1.22,1.22l0,0c0,0.67-0.55,1.22-1.22,1.22h-7.14c-0.67,0-1.22-0.55-1.22-1.22l0,0 C56.65,66.93,57.2,66.39,57.87,66.39L57.87,66.39z" />
											</g>
										</svg> Laptop an PC
									</span>
								</label>
								<label class="radio-box">
									<input required <?php if ($row['pro_type'] == 'smartwatch') {
														echo 'checked';
													} ?> type="radio" class="radios" name="pro-Type" value="smartwatch"
										onclick="inputChange(3)">
									<span class="radio-span">
										<svg class="svg3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											<path
												d="M296.28 182.69h1.643l-6.486-81.131h-72.874l-6.477 81.132h1.634a27.521 27.521 0 0 0-27.533 27.538v95.066a27.509 27.509 0 0 0 25.899 27.45l6.477 77.696h72.874l6.476-77.696a27.51 27.51 0 0 0 25.9-27.45v-95.07a27.527 27.527 0 0 0-27.534-27.534zm-1.27 121.493h-80.03V211.33h80.03z"
												data-name="Smart Watch" />
										</svg>Smartwatches and Fitness
									</span>
								</label>
								<label class="radio-box">
									<input required <?php if ($row['pro_type'] == 'headphones') {
														echo 'checked';
													} ?> type="radio" class="radios" name="pro-Type" value="headphones"
										onclick="inputChange(4)">
									<span class="radio-span">
										<svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor"
											class="bi bi-headphones" viewBox="0 0 16 16">
											<path
												d="M8 3a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a6 6 0 1 1 12 0v5a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1V8a5 5 0 0 0-5-5" />
										</svg>Earphone and Headphones
									</span>
								</label>
								<label class="radio-box">
									<input required type="radio" class="radios" name="pro-Type" value="headphones" onclick="inputChange(5)">
									<span class="radio-span">
										<svg height="17px" width="17px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
											viewBox="0 0 512 512" xml:space="preserve">
											<g>
												<g>
													<g>
														<path style="fill:#231F20;" d="M365.157,434.238H146.843c-10.765,0-19.492,8.727-19.492,19.492
				c0,10.765,8.727,19.492,19.492,19.492h218.315c10.765,0,19.492-8.727,19.492-19.492
				C384.65,442.966,375.922,434.238,365.157,434.238z" />
														<path style="fill:#231F20;" d="M479.513,38.777H32.487C14.574,38.777,0,53.351,0,71.264v293.789
				c0,17.914,14.574,32.487,32.487,32.487h447.025c17.914,0,32.487-14.574,32.487-32.487V71.264
				C512,53.351,497.426,38.777,479.513,38.777z M425.367,370.779c-5.645,0-10.222-4.577-10.222-10.222
				c0-5.645,4.577-10.222,10.222-10.222c5.645,0,10.222,4.577,10.222,10.222C435.589,366.202,431.013,370.779,425.367,370.779z
				 M460.02,304.081c0,10.765-8.727,19.492-19.492,19.492H71.472c-10.765,0-19.492-8.727-19.492-19.492V110.249
				c0-10.765,8.727-19.492,19.492-19.492h369.056c10.765,0,19.492,8.727,19.492,19.492V304.081z" />
													</g>
												</g>
											</g>
										</svg>
										TeleVison
									</span>
								</label>


							</div>
							<div class="inside-box">
								<p class="headings">Product Details </p>
								<div class="details">
									<div class="label1 input">
										<label for="pro-name">
											Product name
											<input required type="text" name="pro-name" value="<?php echo $row['pro_name'] ?>"
												placeholder="Enter the displaying name">
										</label>
									</div>
									<div class="label2 input">
										<label for="pro-brand">Brand
											<select name="pro-brand" id="brand-value" required>
												<option value="" selected><?php echo $row['pro_brand'] ?></option>
											</select>
										</label>
									</div>
								</div>
								<div class="details">
									<div class="label1 input">
										<label for="pro-name">
											Stocks Adding
											<input required type="number" min="3" max='90' name="pro-stocks" value="<?php echo $row['pro_stocks'] ?>"
												placeholder="Enter the number of stocks">
										</label>
										<h6 style="margin: 0px 20px; color:#3f4040">Should be Less than 40</h6>
									</div>

								</div>
								<div class="description">
									<p>Product Description </p>

									<div class="textarea">
										<textarea name="description" id=""
											placeholder="Copy and Paste Expected"><?php echo $row['pro_description'] ?>    </textarea>
									</div>
								</div>
							</div>
						</div>



					</div><input type="text" name="id" value="<?php echo $id ?>" hidden>
				</form>
			</div>
		</body>





<?php
		$already_image = $row['pro_src'];
	}
} ?>
<script src="../utils/colors.js" defer></script>
<script>
	fileImage = document.getElementById('file-image')
	fileName = document.querySelector('#file-name')
	file = document.getElementById('file')
	proBrand = document.getElementById('brand-value')
	discountValue = document.getElementById('discount-value');
	discountPrice = document.getElementById('discount-price')
	originalValue = document.getElementById('original-price')
	messageBox = document.getElementById('message');



	file.addEventListener('change', (event) => {
		if (file.files.length > 0) {
			fileName.textContent = file.files[0].name;
			fileImage.style.display = "block";
			fileImage.src = URL.createObjectURL(event.target.files[0])
			let fileType = event.target.files[0].type.split('/')[1]

			if (event.target.files[0].size > 5242880) {
				console.log('large');
				tooLarge()
				return

			}
			if (fileType == 'png' || fileType == 'jpeg' || fileType == 'jpg' || fileType == 'webp') {
				removeWarning()
				console.log('sucess', );
				console.log(">", fileType, "<");



			} else {
				typeProblem()
			}


		} else {

		}
	})

	function tooLarge() {
		messageBox.textContent = "Image size too large only accept image less than 4.1 mb :( "

		file.parentElement.parentElement.parentElement.parentElement.classList.add('error');
		file.parentElement.classList.add('error');

	}

	function typeProblem() {
		messageBox.textContent = "Image type not accepted Only support png, jpg, or jpeg :( "
		file.parentElement.parentElement.parentElement.parentElement.classList.add('error');
		file.parentElement.classList.add('error');

	}

	function removeWarning() {
		messageBox.textContent = ""
		file.parentElement.classList.remove('error');
		file.parentElement.parentElement.parentElement.parentElement.classList.remove('error');
	}

	function custom(p) {
		messageBox.textContent = p;
	}
	const brandOptions = {
		laptop: ["Apple",
			"Dell",
			"HP",
			"Lenovo",
			"Asus",
			"Acer",
			"Microsoft",
			"MSI",
			"Razer",
			"Samsung",
			"LG",
			"Huawei",
			"Toshiba",
			"Sony",
			"Google",
			"Xiaomi",
			"Realme",
			"Alienware",
			"Gigabyte"
		],
		mobile: ["Apple", "Samsung", "Xiaomi", "OnePlus", "Realme", "Oppo", "Vivo", "Google", "Motorola", "Sony", "Nokia", "Asus", "Lenovo", "Micromax", "Lava", "Infinix", "Tecno", "ZTE", "Honor", "Huawei"],
		smartwatch: ["Apple", "Samsung", "Fitbit", "Garmin", "Amazfit", "Fossil", "Huawei", "OnePlus", "Realme", "Xiaomi", "Noise", "Boat", "Honor", "Pebble", "TicWatch"],
		headphones: [
			"Sony",
			"Bose",
			"JBL",
			"Sennheiser",
			"Boat",
			"Boult",
			"Skullcandy",
			"Apple",
			"Samsung",
			"Beats",
			"Anker (Soundcore)",
			"Realme",
			"OnePlus",
			"Xiaomi",
			"Logitech",
			"HyperX",
			"Razer",
			"SteelSeries",
			"Plantronics",
			"Marshall",
			"Philips",
			"Harman Kardon",
			"Bowers & Wilkins",
			"Edifier",
			"Creative",
			"AKG",
			"Bang & Olufsen"
		],
		tv: ['Sony', 'Samsung', 'LG', 'Panasonic', 'TCL', 'Hisense', 'Vizio', 'Philips', 'Sharp', 'Toshiba', 'OnePlus', 'Mi (Xiaomi)', 'Realme', 'Vu', 'Sanyo', 'Haier', 'Onida', 'Thomson', 'iFFALCON', 'Kodak', 'Blaupunkt', 'Skyworth', 'Insignia', 'Hitachi', 'LeEco', 'Westinghouse', 'Nokia', 'Motorola', 'JVC', 'Akai'],
	};

	function inputChange(c) {
		proBrand.innerHTML = ""
		switch (c) {

			case 1: {
				brandOptions.mobile.forEach((e) => {
					proBrand.innerHTML += `<option value="${e.toLowerCase()}">${e}</option>`
				})
				break;
			}
			case 2: {
				brandOptions.laptop.forEach((e) => {
					proBrand.innerHTML += `<option value="${e.toLowerCase()}">${e}</option>`
				})
				break
			}
			case 3: {
				brandOptions.smartwatch.forEach((e) => {
					proBrand.innerHTML += `<option value="${e.toLowerCase()}">${e}</option>`
				})
				break
			}
			case 4: {
				brandOptions.headphones.forEach((e) => {
					proBrand.innerHTML += `<option value="${e.toLowerCase()}">${e}</option>`
				})
				break
			}
			case 5: {
				brandOptions.tv.forEach((e) => {
					proBrand.innerHTML += `<option value="${e.toLowerCase()}">${e}</option>`
				})
				break
			}
			default: {
				proBrand.innerHTML = "<option> Provide an option </option>"
			}
		}
	}

	function discountCalc(e) {
		//(price * discount) / 100;
		// let discountPrice = price - discountAmount;
		let discount = (originalValue.value - (originalValue.value * discountValue.value) / 100)
		discountPrice.value = discount.toFixed(2)
	}
</script>

<?php
if (!empty($_POST['submit'])) {
	$target_dir = "../product-images/";
	$randomString = bin2hex(random_bytes(10));

	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$_FILES['file']['name'] = $randomString . "." . $imageFileType;

	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$file_name = $_FILES['file']['name'];
	if (!is_dir($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	$maxSize = 4000000;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	if ($_FILES["file"]["size"] > $maxSize) {
		//echo "<h1>Sorry, your file is too large Or File type " . $_FILES['file']['size'] . "</h1><br>";
		echo "<script>tooLarge()</script>";
	} else {
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp") {
			//echo "<h1> File type ==>>" . $_FILES['file']['type'] . " bytes not supported</h1><br>";
			echo "<script>typeProblem()</script>";
		} else {
			// Move the uploaded file to the target directory
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				echo "<h1>Uploaded</h1>" . " Image size " . $_FILES['file']['size'] . "<br>Allowded size $maxSize";

				$stocks = $_POST['pro-stocks'];
				$description = mysqli_real_escape_string($conn, $_POST['description']); // Escape special characters
				$p_name = mysqli_real_escape_string($conn, $_POST['pro-name']);
				$brand = mysqli_real_escape_string($conn, strtolower($_POST['pro-brand']));
				$type = mysqli_real_escape_string($conn, strtolower($_POST['pro-Type']));
				$discount_price = $_POST['discount-price'];
				$price = $_POST['price'];
				if (strlen($p_name) > 20) {
					$pro_simple_name = substr($p_name, 0, 20);
					$pro_simple_name .= "....";
				} else {
					$pro_simple_name = $p_name . "...";
				}

				// Correct SQL query
				$sql = "UPDATE products 
SET 
    pro_name = '$p_name',
    pro_price = '$price',
    pro_simple_name = '$pro_simple_name',
    pro_discount_price = '$discount_price',
    pro_type = '$type',
    pro_brand = '$brand',
    pro_stocks = '$stocks',
    pro_description = '$description',
    pro_src = '$file_name'
    
WHERE pid = $id";

				// Function for insertion
				function insert_data($conn, $sql)
				{
					global $already_image;
					if ($conn->query($sql) === TRUE) {
						echo "<script>alert('Success');location.href='all-product.php'</script>";
						unlink("../product-images/" . $already_image);
					} else {
						echo "<script>alert('Data insertion error')</script>";
						echo "Error: " . $conn->error; // Display detailed error
						exit();
					}
				}

				// Call the function
				insert_data($conn, $sql);
			} else {
				echo "<script>custom('Error: Unable to move the uploaded file to the target directory.')</script>";
				var_dump($_FILES['file']['error']);
			}
		}
	}
}

?>

		</html>