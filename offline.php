<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

<?php 
    if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $cmrId = Session::get("cmrId");
        $insertOrderData = $cart->InsertOrderData($cmrId);
        $delData = $cart->delCustomerCart();
        header("location:success.php");
    }
?>


 <style >
    .divission{width: 50%; float: left;}
    .tblone{width: 500px;margin:0 auto; border:20px solid blue; background-color: #82E0AA!important;}
    .tblone tr td{text-align: justify;background-color: #003300!important; color: white}
    .tblone tr td a{color: white}

    .tbltwo{
        float: right;text-align: left; width: 60%;border:10px solid #00CC00; margin-right: 14px; margin-top: 12px;
    }
    .tbltwo tr td{text-align: justify; padding: 5px 10px;background-color: #003300!important; color: white}
    .order{}
    .order a{width: 200px;margin: 20px auto 0; padding: 5px; text-align: center; display: block; background-color: #006600 !important; border:1px solid #333; color: #fff; border-radius: 3px; font-size: 25px;margin-bottom: 10px}
 </style>

 <div class="main">
    <div class="content">
    	<div class="section group">

            <div class="divission">
                <table class="tblone">
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
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
                                
                                <td>$<?php echo $result['price']; ?></td>
                                <td><?php echo $result['quantity']; ?></td>
                                <td>$<?php

                                $total = $result['price'] * $result['quantity'];

                                 echo $total; ?></td>
                                

                            

                            </tr>

                            <?php 

                                $qty = $qty + $result['quantity'];
                                $sum = $sum + $total;

                            ?>

                            <?php } } ?>
                            

                            
                            
                        </table>


                        <table class="tbltwo">
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>$<?php echo $sum ; ?></td>
                            </tr>
                            <tr>
                                <td>VAT</td>
                                <td>:</td>
                                <td>10% ($<?php echo $vat = $sum * 0.1; ?>)</td>
                            </tr> 
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td>$<?php 

                                    $vat = $sum * 0.1;
                                    $gtotal = $sum + $vat;
                                    echo $gtotal;

                                 ?> </td>
                            </tr>
                            <tr>
                    <td>Quantity</td>
                    <td>:</td>
                    <td><?php echo $qty; ?></td>
                </tr>
                       </table>
            </div>

            <div class="divission">
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
                    
                    <td colspan="3" class="order"><a href="editprofile.php">Update Profile</a></td>
                </tr>
                
            </table>

        <?php } } ?>
            </div>

 		</div>
 	</div>
    <div class="order"><a href="?orderid=order">Order Now</a></div>
<?php include 'inc/footer.php'; ?>