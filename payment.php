<?php include 'inc/header.php'; ?>

<?php 
    $login = Session::get("cuslogin");
    if ($login == false) {
        header("location:login.php");
    }

 ?>

 <style >
 	.payment{width: 500px;min-height: 200px;text-align: center;border: 10px solid #CC0099; margin:0 auto; padding: 50px; background-image: url("jony.png"); }
    .payment h2{border-bottom: 1px solid #ddd; margin-bottom:73px; padding-bottom: 10px; color: white; font-weight: bold;}
    .payment a{background:#CC0000  none repeat scroll 0 0;border-radius: 3px;color: #fff;font-size: 25px;padding: 5px 30px;}
    .content{background: #333300}
    .back{}
    .back a{width: 160px;margin: 20px auto 0; padding: 7px 0; text-align: center; display: block; background: #555; border:1px solid #333; color: #fff; border-radius: 3px; font-size: 25px}
 </style>

 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="payment">
                <h2>Choose Payment Method</h2>
                <a href="offline.php">Offline Payment</a>
                <a href="online.php">Online Payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Back to Cart</a>
            </div>
 		</div>
 	</div>
<?php include 'inc/footer.php'; ?>