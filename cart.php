<?php include 'inc/header.php'; ?>

<?php 

    if (isset($_GET['delpro'])) {
        
        $id = $_GET['delpro'];
        $delPro  = $cart->delPro($id);
    }

?>

<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quantity = $_POST['quantity'];
        $cartId = $_POST['cartId'];
        $updateCart  = $cart->cartUpdate($quantity,$cartId); 

        if ($quantity <=0) {
        	$delPro  = $cart->delPro($cartId);
        }
      }


 ?>

 <?php 

 	if (!isset($_GET['id'])) {
 		echo "<meta http-equiv='refresh' content='0; url=?id=live'/>";
 	}

  ?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

			    <?php 
                    if (isset($updateCart)) {
                        echo $updateCart;
                    }

                 ?>

                 <?php 
			        if (isset($delPro)) {
			            echo $delPro;
			        }

			     ?>

						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
									$getAllcart = $cart->getAllCart();
									if ($getAllcart) {
										$i   = 0;
										$sum = 0;
										$qty = 0;
										while ($result = $getAllcart->fetch_assoc()) {
											$i++;
											?>


							<tr>

								


								<td><?php echo $i; ?></td>
								<td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><?php echo $result['productName']; ?></a></td>
								<td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><img src="admin/<?php echo $result['image']; ?>" alt=""/></a></td>
								<td>$<?php echo $result['price']; ?></td>
					<td>
						<form action="" method="post">
							<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
							<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
							<input type="submit" name="submit" value="Update"/>
						</form>
					</td>
								<td>$<?php

								$total = $result['price'] * $result['quantity'];

								 echo $total; ?></td>
								<td><a onclick="return confirm('Are you sure want to Delete!')" href="?delpro=<?php echo $result['cartId']; ?>">X</a></td>

							

							</tr>

							<?php 

								$qty = $qty + $result['quantity'];
								$sum = $sum + $total;
								Session::set("sum",$sum);
								Session::set("qty",$qty);

							?>

							<?php } } ?>
							

							
							
						</table>

						<?php 
							$getData = $cart->checkCartTable();
									if ($getData) {

						 ?>

						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum ; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php 

									$vat = $sum * 0.1;
									$gtotal = $sum + $vat;
									echo $gtotal;

								 ?> </td>
							</tr>
					   </table>
					<?php } else{

						header("location:index.php");
						/*echo "Cart Empty! Please Shop Now";*/
					} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>