<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

<style type="text/css">
	table.tblone img {
    height: 90px;
    width: 100px;
}
</style>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>

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
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php 
									
									$cmrId = Session::get("cmrId");
									$getAllcompare = $cart->getAllCompare($cmrId);
									if ($getAllcompare) {
										$i   = 0;
										while ($result = $getAllcompare->fetch_assoc()) {
											$i++;
											?>


							<tr>

								


								<td><?php echo $i; ?></td>
								<td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><?php echo $result['productName']; ?></a></td>
								
								<td>$<?php echo $result['price']; ?></td>
								
								<td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><img src="admin/<?php echo $result['image'];?>" height="40px!important" width="60px" /></a></td>
								<td><a href="details.php?proid=<?php echo $result['productId'];  ?>">View</a></td>

							

							</tr>

							<?php } } ?>
							

							
							
						</table>

						
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%;text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>