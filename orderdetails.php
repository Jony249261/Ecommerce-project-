<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

<?php 

    if (isset($_GET['delorder'])) {
        
        $id = $_GET['delorder'];
        $delorder  = $cart->delOrder($id);
    }

?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="order">
    			<h2>Your Ordered Details</h2>
                <table class="tblone">
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                                    $cmrId = Session::get("cmrId");
                                    $getorderedproduct = $cart->getOrderedProduct($cmrId);
                                    if ($getorderedproduct) {
                                        $i   = 0;
                                        while ($result = $getorderedproduct->fetch_assoc()) {
                                            $i++;
                                            ?>


                            <tr>

                                


                                <td><?php echo $i; ?></td>
                                <td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><?php echo $result['productName']; ?></a></td>
                                <td><a href="details.php?proid=<?php echo $result['productId'];  ?>"><img src="admin/<?php echo $result['image']; ?>" alt=""/></a></td>
                                <td><?php echo $result['quantity']; ?></td>       <td>$<?php

                                $total = $result['price'];

                                 echo $total; ?></td>
                                 <td><?php echo $fm->formatDate($result['date']);  ?></td>
                                 <td><?php  
                                    if ($result['status'] == 0) {
                                        echo "Pending";
                                    }elseif ($result['status'] == 1) {
                                          echo "Shifted";
                                    }else{
                                        echo "Confirm";
                                    }

                                  ?></td>
                                <td>
                                    <?php  
                                    if ($result['status'] == 2) {?>
                                        <a onclick="return confirm('Are you sure want to Delete!')" href="?delorder=<?php echo $result['id']; ?>">X</a>
                                    <?php }else{
                                        echo "N/A";
                                    }

                                  ?>

                                </td>

                            

                      
                            <?php } } ?>
                            

                            
                            
                        </table>
    		</div>
    	</div>	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>