<?php include 'inc/header.php'; ?>

<?php 
	$login = Session::get("cuslogin");
	if ($login == true) {
		header("location:order.php");
	}

 ?>

<?php 
			    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
			        
			        $customerlogin   = $customer->customerLogin($_POST); 
			    }

			?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">

    	 	 <?php 
                    if (isset($customerlogin)) {
                        echo $customerlogin;
                    }
             ?>

        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                	<input name="email" placeholder="Email" type="text">
                    <input name="password" placeholder="Password" type="password">
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>

         	</form>
                    
    	<div class="register_account">

    		<?php 
			    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			        
			        $customerReg   = $customer->customerRegistration($_POST); 
			    }

			?>

    		<h3>Register New Account</h3>
    		 <?php 
                    if (isset($customerReg)) {
                        echo $customerReg;
                    }
             ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Your Name..">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter Your City..">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Enter Your Zip-code..">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Your Email..">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Your Address..">
						</div>

						<div>
							<input type="text" name="country" placeholder="Enter Your Country..">
						</div>
		    				        
	
		           <div>
		          		<input type="text" name="phone" placeholder="Enter Your Phone..">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter Your Password..">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>