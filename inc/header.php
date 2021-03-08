<?php 

    include 'lib/Session.php';
    Session::init();

    include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

	

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new Format();
	$cat = new Category();
	$cart = new Cart();
	$product = new Product();
	$brand = new Brand();
	$customer = new Customer();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/styled.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="get">
				    	<input type="text" name="search" placeholder="Search Keywords..."/>
				    	<input type="submit" name="submit" value="Search"/>
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 

									$getData = $cart->checkCartTable();
									if ($getData) {
										
										$sum = Session::get("sum");
										echo "$".$sum;
										$qty = Session::get("qty");
										echo " ~ Qty:".$qty;
									}else{
										echo "Empty";
									}
										

									 ?>


								</span>
							</a>
						</div>
			      </div>

	    <?php 
	    	if (isset($_GET['cid'])) {
	    		$delData = $cart->delCustomerCart();
	    		$delCompareData = $cart->delCustomerCompare();
	    		Session::Destroy();
	    	}

	     ?>

		   <div class="login">

	   	<?php 
		    $login = Session::get("cuslogin");
		    if ($login == false) {?>

		        <a href="login.php">Login</a>

		    <?php } else{?>
		    	<a href="?cid=<?php Session::get('cmrId') ?>">Logout</a>
		    <?php } ?>

		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  
	  <li><a href="topbrands.php">Top Brands</a></li>

	  <?php 
	  		$chkCart = $cart->checkCartTable();
	  		if ($chkCart) {?>
	  			<li><a href="cart.php">Cart</a></li>
	  			<li><a href="payment.php">Payment</a></li>

	  <?php } ?>

	  <?php 
	  		$cmrId = Session::get("cmrId");
	  		$chkOrder = $cart->checkOrder($cmrId);
	  		if ($chkOrder) {?>
	  			
	  			<li><a href="orderdetails.php">Order Details</a></li>

	  <?php } ?>

	  
	  <?php 
		    $login = Session::get("cuslogin");
		    if ($login == true) {?>

		        <li><a href="profile.php">Profile</a> </li>

		    <?php } ?>

		 <?php 
		    $login = Session::get("cuslogin");
		    if ($login == true) {?>
		    	<?php
		    	$cart = new Cart(); 
	  		$cmrId = Session::get("cmrId");
	  		$chkcompare = $cart->checkCompare($cmrId);
	  		if ($chkcompare) {?>
	  			
	  			<li><a href="compare.php">Comapre</a> </li>>

	  <?php } ?>

		        

		    <?php } ?>
	<?php 
	  		$cmrId = Session::get("cmrId");
	  		$chkwlist = $cart->checkWlist($cmrId);
	  		if ($chkwlist) {?>
		    	
	  <li><a href="wlist.php">WishList</a> </li>

	<?php } ?>

	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>