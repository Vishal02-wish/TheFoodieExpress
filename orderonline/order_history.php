<header class="masthead">
	<div class="container h-100">
		<div class="row h-100 align-items-center justify-content-center text-center">
			<div class="col-lg-10 align-self-end mb-4 page-title">
				<h3 class="text-white">Order History</h3>
				<hr class="divider my-4" />
			</div>
		</div>
	</div>
</header>

<section class="page-section" id="order-history">
    <div class="container">
        <?php 
            include 'admin/db_connect.php';
            $user_id = $_SESSION['login_user_id'];
        ?>
        <?php 
            $sql = "SELECT DISTINCT orders.id as order_id
                    FROM orders
                    WHERE orders.user_id = $user_id ORDER BY order_id DESC";

            $order_qry = $conn->query($sql);
        ?>
        <?php while($order_row = $order_qry->fetch_assoc()): ?>
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4>Order No  <?php echo $order_row['order_id']; ?></h4>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 71px;">Sr No.</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Dish Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $order_id = $order_row['order_id'];
                                        $order_sql = "SELECT order_list.qty, product_list.name, product_list.price 
                                                    FROM order_list
                                                    JOIN product_list ON order_list.product_id = product_list.id
                                                    WHERE order_list.order_id = $order_id";
                                        $order_qry_inner = $conn->query($order_sql);

                                        $counter = 1;

                                        $total_price = 0;
                                    ?>
                                    <?php while($row = $order_qry_inner->fetch_assoc()): ?>
                                        <tr style="line-height: 0.2;">
                                            <td style="width: 50px;"><?php echo $counter; ?></td>
                                            <td class="text-truncate"><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['qty'] ?></td>
                                            <td>₹<?php echo $row['price'] ?></td>
                                        </tr>
                                        <?php 
                                            $counter++;      
                                            $total_price += $row['price'] * $row['qty'];
                                        ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                       
                            <div class="mt-3">
                                <strong>Total Price:</strong> ₹<?php echo $total_price; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
