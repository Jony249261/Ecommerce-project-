<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

 <style >
 	.tblone{width: 550px;margin:0 auto; border:20px solid blue; background-color: #82E0AA!important;}
 	.tblone tr td{text-align: justify;background-color: #009966!important;background-image: url("jony3.png"); color:white;}
 </style>

 <div class="main">
    <div class="content"  style="background-color: #82E0AA !important">
    	<div class="section group" style="background-color: #82E0AA !important;background-image: url('jony2.jpg')">

    		<?php

    			$id = Session::get("cmrId"); 
    			$getuserdata = $customer->getUserData($id);
    			if ($getuserdata ) {
    				while ($result = $getuserdata->fetch_assoc()) {?>
    					

    		<table class="tblone" style="background-color: #82E0AA !important">
    			<tr>
    				<td colspan="3" style="text-align: center;font-weight: bold;font-size: 30px">User Profile</td>
    				
    				
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
    				<td>Address</td>
    				<td>:</td>
    				<td><?php echo $result['address']; ?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
    				<td><?php echo $result['city']; ?></td>
    			</tr>
    			<tr>
    				<td>Zipcode</td>
    				<td>:</td>
    				<td><?php echo $result['zip']; ?></td>
    			</tr>
    			<tr>
    				<td>Country</td>
    				<td>:</td>
    				<td><?php echo $result['country']; ?></td>
    			</tr>
    			<tr>
    				
    				<td colspan="3" style="text-align: center;font-weight: bold;font-size: 20px"><a href="editprofile.php">Update Profile</a></td>
    			</tr>
    		</table>

    	<?php } } ?>

 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>