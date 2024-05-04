<style>
		.custom-menu {
			z-index: 1000;
			position: absolute;
			background-color: #ffffff;
			border: 1px solid #0000001c;
			border-radius: 5px;
			padding: 8px;
			min-width: 13vw;
		}
	a.custom-menu-list {
			width: 100%;
			display: flex;
			color: #4c4b4b;
			font-weight: 600;
			font-size: 1em;
			padding: 1px 11px;
	}
		span.card-icon {
			position: absolute;
			font-size: 3em;
			bottom: .2em;
			color: #ffffff80;
	}
	.file-item{
		cursor: pointer;
	}
	a.custom-menu-list:hover,.file-item:hover,.file-item.active {
			background: #80808024;
	}
	a.custom-menu-list span.icon{
			width:1em;
			margin-right: 5px
	}
	
	.card-body{
		text-align:center;
	}

	.card {
		border: 2px solid #333;
	}

	.container {
		display: flex;
	}
</style>

<?php
  if (!isset($_SESSION['login_id']))
    header('location:login.php');
  include('./header.php');
?>

<div class="container-fluid">
	<div class="row	mt-3 ml-3 mr-3">

		<div class="col-lg-12 mb-3">
				<div class="card">
					<div class="card-body">
						<?php echo "Good Day Vishal 😊"  ?><br>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 mb-2">
				<div class="card">
					<div class="card-body">
						<?php
							include 'db_connect.php';
							$total_income = 0;
							$sql = "SELECT order_list.qty, product_list.price 
							FROM order_list 
							JOIN product_list ON order_list.product_id = product_list.id 
							JOIN orders ON order_list.order_id = orders.id 
							WHERE orders.status = 1";
			 
			 $result = $conn->query($sql);
			 
			 if ($result) {
				 while ($row = $result->fetch_assoc()) {
					 $total_income += $row['qty'] * $row['price'];
					}
				}
				echo '<i class="fas fa-money-bill-alt"></i> Total Income: ₹' . number_format($total_income); 
				?>
					</div>
				</div>
			</div>

			<div class="col-lg-4 mb-2">
				<div class="card">
				<div class="card-body">
    <?php
        $sql = "SELECT COUNT(*) FROM orders WHERE status = 1";
        $completed_orders = $conn->query($sql);

        $count = $completed_orders->fetch_assoc()['COUNT(*)'];

        echo '<i class="fas fa-check-circle"></i> Completed Orders: ' . $count;
    ?>
</div>

				</div>
			</div>

			<div class="col-lg-4 mb-2">
				<div class="card">
					<div class="card-body">
						<?php
							$sql = "SELECT COUNT(*) FROM orders WHERE status = 0";
							$pending_orders = $conn->query($sql);

							$count = $pending_orders->fetch_assoc()['COUNT(*)'];

							echo '<i class="fas fa-hourglass-half"></i> Pending Orders: ' . $count;
						?>
					</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>