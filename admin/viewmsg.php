<?php include 'inc/header.php'; ?>
<?php include '../classes/Customer.php'; ?>

<?php 


    if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL) {
        echo "<script>window.location='contact.php';</script>";
    } else {
        $id = $_GET['viewid'];
    }
        
?>


 <style >
 	.tblone{width: 550px; min-height: 400px; margin:0 auto; border:20px solid blue; background-color: #82E0AA!important;}
 	.tblone tr td{text-align: justify;background-color: #009966!important;background-image: url("jony3.png"); color:white; padding-left: 10px}
 </style>

 <div class="main">
    <div class="content"  style="background-color: #82E0AA !important">
    	<div class="section group" style="background-color: #82E0AA !important;background-image: url('jony2.jpg')">

    		<?php

    			$customer = new Customer(); 
    			$viewmsg = $customer->viewMsg($id);
    			if ($viewmsg ) {
    				while ($result = $viewmsg->fetch_assoc()) {?>
    					

    		<table class="tblone" style="background-color: #82E0AA !important">
    			<tr>
    				<td colspan="3" style="text-align: center;font-weight: bold;font-size: 30px">User Message</td>
    				
    				
    			</tr>
    			
    			<tr>
    				<td width="20%">Name</td>
    				<td width="5%">:</td>
    				<td><?php echo $result['name']; ?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
    				<td><?php echo $result['phone']; ?></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    				<td><?php echo $result['email']; ?></td>
    			</tr>
    			<tr>
    				<td>Message</td>
    				<td>:</td>
    				<td><?php echo $result['body']; ?></td>
    			</tr>
    			<tr>
    				<td>Date</td>
    				<td>:</td>
    				<td><?php echo $result['date']; ?></td>
    			</tr>
    			<tr>
    				
    				<td colspan="3" style="text-align: center;font-weight: bold;font-size: 20px"><a href="contact.php">Back to Inbox</a></td>
    			</tr>
    		</table>

    	<?php } } ?>

 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>