<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

 <style >
 	.psuccess{width: 500px;min-height: 200px;text-align: center;border: 10px solid #CC0099; margin:0 auto; padding: 50px; background-image: url("jony.png"); }
    .psuccess h2{border-bottom: 1px solid #ddd; margin-bottom:73px; padding-bottom: 10px; color: white; font-weight: bold;}
    .psuccess{line-height: 25px;color: black;font-weight: bold; }
    .psuccess p a{color:yellow;}
    
    .content{background: #333300}
 
 </style>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="psuccess">
                <h2>Order Success</h2>
                <?php 
                    $cmrId = Session::get("cmrId");
                    $amount = $cart->payableAmount($cmrId);
                    if ($amount) {
                        $sum = 0;
                        while ($result = $amount->fetch_assoc()) {
                            $price = $result['price'];
                            $sum = $sum + $price;
                        }
                    


                 ?>
                <p>Total Payable Amount (Including Vat) :$
                    <?php 
                        $vat = $sum * 0.1;
                        $Total = $sum + $vat;
                        echo $Total;
                     ?>
                </p>
            <?php } ?>
                <p>Thanks for Purchase.Receive Your Succesfully.We will contact you  ASAP with delivery details.Here is your order details....<a href="orderdetails.php">Visit Here</a></p>
                 <a href="index.php"> <img src="images/shop.png" alt="" /></a>
            </div>
                        
        </div>
    </div>

 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>