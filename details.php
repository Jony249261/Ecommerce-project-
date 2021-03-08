<?php include 'inc/header.php'; ?>

<?php 


    if (isset($_GET['proid'])) {
        
        $id = $_GET['proid'];
    }

   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $addCart  = $cart->addToCart($quantity,$id); 
      }


      		$cmrId = Session::get("cmrId");
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
                $productId = $_POST['productId'];
                $insertforcompare   = $product->insertCompareData($productId,$cmrId); 
            }

    

?>
<?php 

		$cmrId = Session::get("cmrId");
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
                $productId = $_POST['productId'];
                $insertforwlist  = $product->insertWlistData($productId,$cmrId); 
            }

 ?>


<style>
	.mybutton{width: 100px;float: left;margin-right: 50px;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

					<?php 

						$getPd = $product->getSingleProduct($id);
						if ($getPd) {
							while ($result = $getPd->fetch_assoc()) {?>
			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>	

					<span style="color:red; font-size: 18px;">
                <?php 
                    if (isset($addCart)) {
                        echo $addCart;
                    }

                 ?>


				</div>
				 <?php 
                    if (isset($insertforcompare)) {
                        echo $insertforcompare;
                    }

                 ?>
                 <?php 
                    if (isset($insertforwlist)) {
                        echo $insertforwlist;
                    }

                 ?>

                 <?php 
				    $login = Session::get("cuslogin");
				    if ($login == true) {?>

				<div class="add-cart">
					<div class="mybutton">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
							<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
						</form>	
					</div>
					<div class="mybutton">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
							<input type="submit" class="buysubmit" name="wlist" value="Add to Wlist"/>
						</form>	

					</div>
				</div>
			<?php } ?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body']; ?>
	    </div>

	<?php } } ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php 
							$getAllCat = $cat->getAllCat();
							if ($getAllCat) {
								while ($result = $getAllCat->fetch_assoc()) { ?>
				      <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				  <?php } } ?>

				      
    				</ul>
    	
 				</div>
 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>