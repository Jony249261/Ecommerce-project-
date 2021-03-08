<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Cart.php'; ?>

<?php 

    if (isset($_GET['viewid'])) {

    	$cart = new Cart();
        
        $id = $_GET['viewid'];
        $msgseen  = $cart->msgSeen($id);
    }

?>

<?php 

    if (isset($_GET['removeid'])) {
        
        $cart = new Cart();
        $id = $_GET['removeid'];
        $removemsg  = $cart->msgRemove($id);
    }

?>




        <div class="grid_10">
            <div class="box round first grid">
                <h2>Pending Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart = new Cart();
							$fm = new Format();
							$getallmessage = $cart->getAllMessage();
							if ($getallmessage) {
								$i=0;
								while ($result = $getallmessage->fetch_assoc()) {
									$i++;
									?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['phone']; ?></td>
							<td><?php echo $result['email'] ?></td>
							<td><?php echo $result['body'] ?></td>
							<td><?php echo $fm->formatDate($result['body']); ?></td>
							<td><a href="?viewid=<?php echo $result['id']; ?>">Seen</a> || <a href="viewmsg.php?viewid=<?php echo $result['id']; ?>">View</a> || <a href="?removeid=<?php echo $result['id']; ?>">Remove</a></td>
							

							
						</tr>
					<?php } } ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
							<th>SL</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart = new Cart();
							$fm = new Format();
							$getallsmsg = $cart->getAllSMsg();
							if ($getallsmsg) {
								$i=0;
								while ($result = $getallsmsg->fetch_assoc()) {
									$i++;
									?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['phone']; ?></td>
							<td><?php echo $result['email'] ?></td>
							<td><?php echo $result['body'] ?></td>
							<td><?php echo $fm->formatDate($result['body']); ?></td>
							<td><a href="?removeid=<?php echo $result['id']; ?>">Remove</a> || <a href="viewmsg.php?viewid=<?php echo $result['id']; ?>">View</a></td>
							

							
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
