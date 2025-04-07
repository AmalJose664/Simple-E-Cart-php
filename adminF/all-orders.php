<?php

include('../utils/admin-checker.php');
include('../utils/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Orders</title>
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
			padding: 8px;
			margin: 10px;
			margin-top: 90px;
		}

		.content {
			width: 100%;
			padding: 4px;
			margin: 10px;

		}

		.orders9090 {
			margin-top: 30px;
			
			height: 700px;
			overflow-y: scroll;

		}

		table {

			width: 100%;

		}

		th,
		td {
			padding: 12px;
			text-align: left;
		}

		th {
			background-color: #f4f4f4;
			transition: 200ms ease-in;
		}

		th:hover {
			transition: 200ms ease-in;
			border-radius: 8px;
			background-color: #dcdcdc;
			cursor: pointer;
		}

		.t-hover:hover {
			background-color: #eeeeee;

			.td-front {
				border-top-left-radius: 9px;
				border-bottom-left-radius: 9px;
			}

			.td-last {
				border-top-right-radius: 9px;
				border-bottom-right-radius: 9px;
			}
		}

		.symbol-t {
			visibility: hidden;
			float: right;
			color: blue;
			font-size: 20px;
			transition: 200ms ease-in;
		}

		.symbol-t.show {
			visibility: visible;
			transition: 200ms ease-in;
		}

		.symbol-t.invert {
			transform: rotate(180deg);
			transition: 200ms ease-in;


		}

		.form-control {
			display: block;
			width: 100%;
			padding: 0.375rem 0.75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: 0.375rem;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}

		.form-control:focus {
			color: #495057;
			background-color: #fff;
			border-color: #86b7fe;
			outline: 0;
			box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
		}

		.form-control::placeholder {
			color: #6c757d;
			opacity: 1;
		}

		.form-control:disabled,
		.form-control[readonly] {
			background-color: #e9ecef;
			opacity: 1;
		}

		.btn-primary {
			background: linear-gradient(to right, var(--highest), var(--theme-color)) !important;
			color: black;
		}
	</style>
</head>
<?php
$select_query = "select * from shopping_orders inner join users on shopping_orders.user_id = users.uid";
$select_results = mysqli_query($conn, $select_query);
?>

<body>
	<?php include('./admin-nav.php') ?>
	<div class="container">
		<div class="content">
			<h2>All Users Orders</h2>
			<div class="orders9090">
				<input onkeyup="searchTable()" type="text" class="form-control" id="searchvalue" style="display: inline; margin: 8px 3px;height: 37px; width: 68%;padding: 7px;" placeholder="Search the table">
				<select onchange="clearInput()" name="" class="form-control" id="searchField" style="display: inline; width: 29%;margin: 8px 0;height: 37px;padding: 7px;">
					<option value="3">Search by</option>
					<option value="1">Order Id</option>
					<option value="2">Date</option>
					<option value="3">Customer</option>
					<option value="4">Amount Total</option>
					<option value="5">Status</option>
					<option value="6">Payment Method</option>
					<option value="7">No of Items</option>
				</select>
				<table id="sTable">
					<thead>
						<tr>
							<th onclick="sortTable(0)">SI.no <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(1)">Order Id <span class="symbol-t">&#9662</span></th>
							<th style="width: 260px;" onclick="sortTable(2)">Date <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(3)">Customer <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(4)">Amount Total <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(5)">Status <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(6)">Payment Method <span class="symbol-t">&#9662</span></th>
							<th onclick="sortTable(7)">No of Items <span class="symbol-t">&#9662</span></th>

							<th style="cursor: not-allowed;">Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$i = 1;
						while ($row = mysqli_fetch_assoc($select_results)) {
							if ($row['delivery_type'] == "Normal") {
								$arrival_time = 7;
							} elseif ($row['delivery_type'] == "Express") {
								$arrival_time = 5;
							} elseif ($row['delivery_type'] == "Sameday") {
								$arrival_time = 2;
							} else {
							}
							$date = new DateTime($row['order_date']);
							$date->modify('+' . $arrival_time . ' days');

							$today_date = new DateTime(date('Y-m-d'));
						?>
							<tr class="t-hover">
								<td class="td-front"><strong><?php echo $i ?></strong></td>
								<td><?php echo $row['order_id'] ?></td>
								<td><?php echo $row['order_date'] ?></td>
								<td><strong><?php echo $row['name'] ?></strong></td>
								<td>₹ <?php echo $row['total_amount'] ?></td>

								<?php
								if ($date > $today_date) {
									echo "<td style='background:var(--accent-color);border-radius:8px;'>Order Placed</td>";
								} elseif ($date < $today_date) {
									echo "<td style='background:#4eebbb;border-radius:8px;'>Placed and Arrived</td>";
								} else {
									echo "<td style='background:#7df493;border-radius:8px;'>Arriving Today</td>";
								}
								?>
								<td><?php echo $row['payment_method'] ?></td>
								<td><?php echo $row['total_quantity'] ?></td>
								<td class="td-last"><a href="all-orders-items.php?id=<?php echo $row['order_id'] ?>" class="btn btn-primary">View More &#x1F8A9;</a></td>
							</tr>

					</tbody>
				<?php
							$i++;
						}
				?>

				</table>

			</div>
		</div>
	</div>
	<script src="../utils/colors.js" defer></script>
	<script>
		let input = document.getElementById('searchvalue')

		let searchField = document.getElementById('searchField')
		const table = document.getElementById('sTable')
		let t = -1

		function sortTable(n) {
			let indicate = table.getElementsByTagName('span')

			if (t == -1) {
				t = n;
				indicate[n].classList.add('show')
			} else if (t == n) {
				indicate[n].classList.toggle('invert')
			} else if (t != n) {
				indicate[n].classList.add('show')
				indicate[t].classList.remove('invert')
				indicate[t].classList.remove('show')
				t = n;
			}

			const rowsArray = Array.from(table.rows).slice(1); // Convert table rows to array (skip header)
			let dir = table.getAttribute("data-sort-dir") || "asc"; // Store the current sort direction

			// Detect if column data is numeric, dates, or strings
			const isNumeric = !isNaN(parseFloat(rowsArray[0].cells[n].innerText));
			const isDate = Date.parse(rowsArray[0].cells[n].innerText);

			// Compare function for sorting
			const compare = (a, b) => {
				let valA = a.cells[n].innerText.toLowerCase();
				let valB = b.cells[n].innerText.toLowerCase();

				// Parse data types
				if (isNumeric) {
					valA = parseFloat(valA);
					valB = parseFloat(valB);
				} else if (isDate) {
					valA = new Date(valA);
					valB = new Date(valB);
				}

				if (dir === "asc") {
					return valA > valB ? 1 : -1;
				} else {
					return valA < valB ? 1 : -1;
				}
			};

			// Sort rows based on comparison function
			rowsArray.sort(compare);

			// Append rows back to table in sorted order
			rowsArray.forEach(row => table.appendChild(row));

			// Toggle sorting direction
			dir = (dir === "asc") ? "desc" : "asc";
			table.setAttribute("data-sort-dir", dir);
		}




		function clearInput() {
			if (searchField.value == "2") {
				input.placeholder = "YYYY-MM-DD"
			} else {
				input.placeholder = "Search the table"
			}
			input.value = ""

			searchTable();
		}

		function searchTable() {

			let filter = input.value.toUpperCase();

			let tr = table.getElementsByTagName('tr')

			let td
			let sOption = searchField.value
			console.log(filter, tr, sOption);

			for (i = 1; i < (tr.length); i++) {


				td = tr[i].getElementsByTagName("td")[parseInt(sOption)];
				console.log(td, "<<<+++")
				if (td) {
					let trText = td.textContent || td.innerHTML;

					if (sOption == "2") {
						let date = new Date(trText)
						trText = date.toISOString().split("T")[0]

					}
					//console.log(trText.toUpperCase().indexOf(filter))
					if (trText.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = ""
					} else {
						tr[i].style.display = "none"
					}
				}

			}
		}
	</script>
</body>

</html>