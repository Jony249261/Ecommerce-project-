<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Cart.php'; ?>

<?php 

    if (isset($_GET['shiftid'])) {

    	$cart = new Cart();
        
        $id = $_GET['shiftid'];
        $proshift  = $cart->proShift($id);
    }

?>
<?php 

    if (isset($_GET['pendingid'])) {

    	$cart = new Cart();
        
        $id = $_GET['pendingid'];
        $propending  = $cart->proPending($id);
    }

?>

<?php 

    if (isset($_GET['removeid'])) {
        
        $cart = new Cart();
        $id = $_GET['removeid'];
        $removepro  = $cart->proRemove($id);
    }

?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Pending</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>CmrId</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart = new Cart();
							$fm = new Format();
							$getallorder = $cart->getAllOrder();
							if ($getallorder) {
								while ($result = $getallorder->fetch_assoc()) {?>

						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['cmrId']; ?>">View Details</a></td>
							<td><?php echo $result['cmrId'] ?></td>

							<?php 

								if ($result['status'] == '0') {?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
								<?php }elseif ($result['status'] == '1') {?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Pending</a></td>
								<?php } else { ?>
									<td><a href="?removeid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Remove</a></td>
								<?php } ?>

							
						</tr>
					<?php } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Shifted</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>CmrId</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart = new Cart();
							$fm = new Format();
							$getalldeliverd = $cart->getAllDeliverd();
							if ($getalldeliverd) {
								while ($result = $getalldeliverd->fetch_assoc()) {?>

						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['cmrId']; ?>">View Details</a></td>
							<td><?php echo $result['cmrId'] ?></td>

							<?php 

								if ($result['status'] == '0') {?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
								<?php }elseif ($result['status'] == '1') {?>
									<td><a href="?pendingid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Pending</a></td>
								<?php } else { ?>
									<td><a href="?removeid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Remove</a></td>
								<?php } ?>

							
						</tr>
					<?php } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Shifted</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>CmrId</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart = new Cart();
							$fm = new Format();
							$getallconformed = $cart->getAllConformed();
							if ($getallconformed) {
								while ($result = $getallconformed->fetch_assoc()) {?>

						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price']; ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['cmrId']; ?>">View Details</a></td>
							<td><?php echo $result['cmrId'] ?></td>

							<?php 

								if ($result['status'] == '0') {?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
								<?php }elseif ($result['status'] == '1') {?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Pending</a></td>
								<?php } else { ?>
									<td><a href="?removeid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Remove</a></td>
								<?php } ?>

							
						</tr>
					<?php } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
