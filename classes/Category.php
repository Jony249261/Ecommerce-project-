<?php 

	$filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

 <?php 
 
 class Category {
 	
 	private $db;
	private $fm;

		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link,$catName);

			if (empty($catName)) {
				$msg = "<span class='error'>Category Name must not be empty !</span>";
				return $msg;
			} else {
				$query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
				$catinsert = $this->db->insert($query);

				if ($catinsert) {
					$msg = "<span class='success'>Category Inserted Successfully</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Category Not Insert Successfully!</span>";
					return $msg;
				}
			}

		}

		public function getAllCat(){
			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id){
			$query = "SELECT * FROM tbl_category WHERE catId='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function catUpdate($catName,$id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link,$catName);
			$id = mysqli_real_escape_string($this->db->link,$id);

			if (empty($catName)) {
				$msg = "<span class='error'>Category Name must not be empty !</span>";
				return $msg;
			} else {
				$query = "UPDATE  tbl_category SET catName='$catName' WHERE catId = '$id'";
				$updated_row = $this->db->update($query);

				if ($updated_row) {
					$msg = "<span class='success'>Category Update Successfully</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Category Not Update Successfully!</span>";
					return $msg;
				}
			}
		}

		public function catDel($id){
			$query ="DELETE FROM `tbl_category` WHERE catId='$id'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					$msg = "<span class='success'>Category Deleted Successfully</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Category Not Deleted Successfully!</span>";
					return $msg;
				}
		}

		public function categoryNameById($id){
			$catId         = mysqli_real_escape_string($this->db->link,$id);
			$query ="SELECT catName FROM `tbl_category` WHERE catId='$catId'";
			$result = $this->db->select($query);
            return $result;
		}


		public function wlistDel($cmrId,$id){
			$query ="DELETE FROM `tbl_wlist` WHERE productId='$id' AND cmrId = '$cmrId'";
			$delete_row = $this->db->delete($query);
			if ($delete_row) {
					$msg = "<span class='success'>Product Remove Successfully</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Product Not Remove Successfully!</span>";
					return $msg;
				}
		}


		public function getAcerPd(){
			
                 $query = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY brandId DESC";
            	 $result = $this->db->select($query);
            	 return $result;
		}

		public function getSamsungPd(){
			
                 $query = "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY brandId DESC";
            	 $result = $this->db->select($query);
            	 return $result;
		}

		public function getCanonPd(){
			
                 $query = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY brandId DESC";
            	 $result = $this->db->select($query);
            	 return $result;
		}

		public function getIphonePd(){
			
                 $query = "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY brandId DESC";
            	 $result = $this->db->select($query);
            	 return $result;
		}


		public function getSearchPd($search){
			
                 $query = "SELECT * FROM `tbl_product` where productName LIKE '%$search%' OR body LIKE '%$search%'";
            	 $result = $this->db->select($query);
            	 return $result;
		}





 }

 ?>