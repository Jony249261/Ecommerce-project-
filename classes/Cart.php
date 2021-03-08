<?php 

	$filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

 <?php 
 
 class Cart {
 	
 	private $db;
	private $fm;

		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function addToCart($quantity,$id){
			$quantity  = $this->fm->validation($quantity);
			$quantity  = mysqli_real_escape_string($this->db->link,$quantity);
			$productId = mysqli_real_escape_string($this->db->link,$id);
			$sId       = session_id();

			$query ="SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result['productName'];
			$price       = $result['price'];
			$image       = $result['image'];

			$chquery     ="SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
			$getPro      =$this->db->select($chquery);

			if ($getPro) {
				header("location:cart.php");
			} else{


			$query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
                        VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";
                        $inserted_rows = $this->db->insert($query);
                        if ($inserted_rows) {

                         header("location:cart.php");


                    }else {
                     header("location:404.php");

                    }
                 }

		}

		public function getAllCart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ORDER BY cartId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function cartUpdate($quantity,$cartId){
			
			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			$cartId = mysqli_real_escape_string($this->db->link,$cartId);

			$query = "UPDATE  tbl_cart SET quantity='$quantity' WHERE cartId = '$cartId'";
				$updated_row = $this->db->update($query);

				if ($updated_row) {
					header("location:cart.php");
				} else {
					
					$msg = "<span class='error'>Quantity Not Update Successfully!</span>";
					return $msg;
				}
			}


		public function delPro($id){
			$query ="DELETE FROM `tbl_cart` WHERE cartId='$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					header("location:cart.php");
				} else {
					
					$msg = "<span class='error'>Product Not Remove Successfully!</span>";
					return $msg;
				}
		}

		public function checkCartTable(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ORDER BY cartId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCustomerCart(){
			$sId = session_id();
			$query = "DELETE FROM `tbl_cart` WHERE sId='$sId'";
			$result = $this->db->delete($query);
			return $result;
		}

		public function InsertOrderData($cmrId){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
			$getdata = $this->db->select($query);
			if ($getdata) {
				while ($result = $getdata->fetch_assoc()) {
					$productId = $result['productId'];
					$productName = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'] * $quantity;
					$image = $result['image'];

					$query = "INSERT INTO tbl_order(cmrId, productId, productName, quantity, price, image) 
                        VALUES('$cmrId', '$productId', '$productName', '$quantity', '$price', '$image')";
                        $inserted_rows = $this->db->insert($query);

				}
			}
		}


		public function payableAmount($cmrId){
			$query = "SELECT price FROM tbl_order WHERE cmrId ='$cmrId' AND date = now()";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderedProduct($cmrId){
			$query = "SELECT * FROM tbl_order WHERE cmrId ='$cmrId' ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cmrId){
			$query = "SELECT * FROM tbl_order WHERE cmrId ='$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function delOrder($id){
			$query ="DELETE FROM `tbl_order` WHERE id='$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					$msg = "<span class='success'>Order Remove Successfully!</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Order Not Remove Successfully!</span>";
					return $msg;
				}
		}

		public function getAllOrder(){
			$query = "SELECT * FROM tbl_order WHERE status = '0' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllDeliverd(){
			$query = "SELECT * FROM tbl_order WHERE status = '1' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllConformed(){
			$query = "SELECT * FROM tbl_order WHERE status = '2' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function proShift($id){
			$query = "UPDATE  tbl_order SET status='1' WHERE id = '$id'";
				$updated_row = $this->db->update($query);

				if ($updated_row) {
					echo "<script>window.location='inbox.php';</script>";
				} else {
					
					$msg = "<span class='error'>Quantity Not Update Successfully!</span>";
					return $msg;
				}
		}

		public function proPending($id){
			$query = "UPDATE  tbl_order SET status='2' WHERE id = '$id'";
				$updated_row = $this->db->update($query);

				if ($updated_row) {
					echo "<script>window.location='inbox.php';</script>";
				} else {
					
					$msg = "<span class='error'>Quantity Not Update Successfully!</span>";
					return $msg;
				}
		}

		public function proRemove($id){
			$query ="DELETE FROM `tbl_order` WHERE id='$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					echo "<script>window.location='inbox.php';</script>";
				} else {
					
					$msg = "<span class='error'>Product Not Remove Successfully!</span>";
					return $msg;
				}
		}

		public function getAllMessage(){
			$query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function msgSeen($id){
			$query = "UPDATE  tbl_contact SET status='1' WHERE id = '$id'";
				$updated_row = $this->db->update($query);

				if ($updated_row) {
					echo "<script>window.location='contact.php';</script>";
				} else {
					
					$msg = "<span class='error'>Quantity Not Update Successfully!</span>";
					return $msg;
				}
		}

		public function getAllSMsg(){
			$query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}


		public function msgRemove($id){
			$query ="DELETE FROM `tbl_contact` WHERE id='$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					echo "<script>window.location='contact.php';</script>";
				} else {
					
					$msg = "<span class='error'>Message Not Remove Successfully!</span>";
					return $msg;
				}
		}


		public function getAllCompare($cmrId){
			$cmrId = mysqli_real_escape_string($this->db->link,$cmrId);
			$query = "SELECT * FROM tbl_compare WHERE cmrId ='$cmrId' ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkCompare($cmrId){
			$query = "SELECT * FROM tbl_compare WHERE cmrId ='$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCustomerCompare(){
			$cmrId = Session::get("cmrId");
			$query = "DELETE FROM `tbl_compare` WHERE cmrId='$cmrId'";
			$result = $this->db->delete($query);
			return $result;
		}

		public function getAllWlist($cmrId){
			$cmrId = mysqli_real_escape_string($this->db->link,$cmrId);
			$query = "SELECT * FROM tbl_wlist WHERE cmrId ='$cmrId' ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkWlist($cmrId){
			$query = "SELECT * FROM tbl_wlist WHERE cmrId ='$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}








	}

?>