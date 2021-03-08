<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>
 <?php 
            
        $cmrId = Session::get("cmrId");
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                
                $customerupdate   = $customer->customerUpdate($_POST,$cmrId); 
            }

?>

 <style >
 	.tblone{width: 550px;margin:0 auto; border:20px solid blue; background-color: #82E0AA!important;}
 	.tblone tr td{text-align: justify;background-color: #009966!important;}
    .tblone input[type="text"]{
        width: 400px;padding: 5px;font-size: 15px;
    }
    .tblone input[type="submit"]{
    background: #602d8d!important;
    border: 1px solid #602d8d!important;
    color: #000!important;
    cursor: pointer;
    font-size: 20px!important;
    width: 100px;
    height: 40px;
    }
 </style>

 <div class="main">
    <div class="content"  style="background-color: #82E0AA !important;">
    	<div class="section group" style="background-color: #82E0AA !important;background-image: url('jony1.jpg')">

    		<?php

    			$id = Session::get("cmrId"); 
    			$getuserdata = $customer->getUserData($id);
    			if ($getuserdata ) {
    				while ($result = $getuserdata->fetch_assoc()) {?>
    					
            <form action="" method="post">
    		<table class="tblone" style="background-color: #82E0AA !important">

    			<tr>
    				<td colspan="2" style="text-align: center;font-weight: bold;font-size: 30px">
                    Update Profile 
                    <?php 
                    if (isset($customerupdate)) {?>
                        <br>
                        <?php 
                        echo $customerupdate;
                    }

                 ?>
                </td>
    				
    				
    			</tr>
    			
    			<tr>
    				<td width="20%">Name</td>
    				<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				
    				<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				
    				<td><input type="text" name="email" value="<?php echo $result['email']; ?>"></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				
    				<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				
    				<td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
    			</tr>
    			<tr>
    				<td>Zipcode</td>
                    <td><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></td>
    			
    			</tr>
    			<tr>
    				<td>Country</td>
    				
    				<td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
    			</tr>
    			<tr>
                    
                    <td colspan="2" style="text-align: center"><input type="submit" name="submit" value="Save"></td>
                </tr>
    		</table>
            </form>

    	<?php } } ?>

 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>