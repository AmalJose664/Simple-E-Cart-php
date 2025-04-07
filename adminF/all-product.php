<?php

include('../utils/admin-checker.php');
include('../utils/connect.php')
?>
<!DOCTYPE html>
<html lang="en">
<?php
$select_query = "select * from products";
$select_results = mysqli_query($conn, $select_query);


if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$find_sql = "select pro_src from products where pid = $id";
	$find_results = mysqli_query($conn, $find_sql);
	while ($row_find = mysqli_fetch_assoc($find_results)) {
		$pro_src = $row_find['pro_src'];
	}
	$delete_sql = "delete from cart where item_id = $id";
	if (mysqli_query($conn, $delete_sql)) {
		$delete_item = "delete from products where pid = $id";
		if (mysqli_query($conn, $delete_item)) {
			echo "<script>alert('Item deleted')</script>";
			//echo "===========================>>>>>>>>>>>>>>".$pro_src;
			unlink('../product-images/' . $pro_src);
		}
	}
	sleep(2);
	header("Location:./all-product.php");
	//echo $delete_sql;
}
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - All Products</title>
	<style>

	</style>
	<link rel="stylesheet" href="./styles-admin/all-product.css ">
	<link rel="stylesheet" href="../utils/colors.css ">
	<link rel="stylesheet" href="../styles/home.css">
	<link rel="shortcut icon" href="/projects/images/E-cart-logo.jpg" type="image/x-icon">
</head>

<body>
	<?php include('./admin-nav.php') ?>
	<div class="container">
		<h1 class="page-title">All Products</h1>
		<div class="btn-box">
			<button class="add-btn" onclick="location.href='./add-product.php'">Add new Items</button>
		</div>
		<ul class="product-list">
			<?php

			while ($row = mysqli_fetch_assoc($select_results)) {


			?>
				<li class="product-item">
					<img src="../product-images/<?php echo $row['pro_src'] ?>" alt="Product Image" onclick="location.href='./product.php?id=<?php echo $row['pid'] ?>'" style="cursor: pointer;" class="product-image">
					<div class="product-info">
						<span class="product-name"><?php echo $row['pro_name'] ?>.....</span>
						<span>Brand: <?php echo $row['pro_brand'] ?></span>
						<span>Type: <?php echo $row['pro_type'] ?></span>
						<span>Stocks: <?php echo $row['pro_stocks'] ?></span>

					</div>
					<div class="product-info">
						<span class="item-price">Price: <?php echo $row['pro_price'] ?></span>
						<span class="discount-price">Discount Price: <?php echo $row['pro_discount_price'] ?></span>
						<span class="description-box">
							<details>
								<summary>Description</summary>
								<?php echo $row['pro_description'] ?>
							</details>
						</span>
						<span>Added Date: <?php echo $row['added_date'] ?></span>
					</div>
					<div class="btn-group">
						<button class="btn-item btn-item-edit" onclick="editProduct(<?php echo $row['pid'] ?>)">Edit</button>
						<button onclick="deleteProduct(<?php echo $row['pid'] ?>,'<?php echo $row['pro_simple_name'] ?>' )" class="btn-item btn-item-delete">Delete</button>
					</div>
				</li>


			<?php } ?>

		</ul>
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
		editProduct = (id) => {
			let innerData = `<form action="edit-items.php" method="post">
					<input type="number" hidden value="${id}" name = 'id'">
				</form>`
			link.innerHTML = innerData;
			document.forms[1].submit();
		}
	</script>
</body>

</html>