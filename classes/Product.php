<?php 

	$filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

 <?php 
 
 class Product {
 	
 	private $db;
	private $fm;

		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function productInsert($data,$file){
			$productName   = $this->fm->validation($data['productName']);
			$productName   = mysqli_real_escape_string($this->db->link,$data['productName']);
			$catId         = $this->fm->validation($data['catId']);
			$catId         = mysqli_real_escape_string($this->db->link,$data['catId']);
			$brandId       = $this->fm->validation($data['brandId']);
			$brandId       = mysqli_real_escape_string($this->db->link,$data['brandId']);
			$body          = $this->fm->validation($data['body']);
			$body          = mysqli_real_escape_string($this->db->link,$data['body']);
			$price         = $this->fm->validation($data['price']);
			$price         = mysqli_real_escape_string($this->db->link,$data['price']);
			$type          = $this->fm->validation($data['type']);
			$type          = mysqli_real_escape_string($this->db->link,$data['type']);


			$permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $file_name == "") {
                    
                    $msg = "<span class='error'>Field must not be empty ! !</span>";
					return $msg;

                } elseif ($file_size >1048567) {
                     echo "<span class='error'>Image Size should be less then 1MB!</span>";

                    } elseif (in_array($file_ext, $permited) === false) {

                     $msg = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                     return $msg;

                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) 
                        VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
                        $inserted_rows = $this->db->insert($query);
                        if ($inserted_rows) {

                         $msg =  "<span class='success'>Post Inserted Successfully.</span>";
                         return $msg;


                    }else {
                     $msg = "<span class='error'>Post Not Inserted !</span>";
                     return $msg;
                    }
                }


		}

		public function getAllCat(){
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
			FROM tbl_product
			INNER JOIN tbl_category
			ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand
			ON tbl_product.brandId = tbl_brand.brandId
			ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProdById($id){
			$query = "SELECT * FROM tbl_product WHERE productId='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function productUpdate($data,$file,$id){

			$productName   = $this->fm->validation($data['productName']);
			$productName   = mysqli_real_escape_string($this->db->link,$productName);
			$catId         = $this->fm->validation($data['catId']);
			$catId         = mysqli_real_escape_string($this->db->link,$catId);
			$brandId       = $this->fm->validation($data['brandId']);
			$brandId       = mysqli_real_escape_string($this->db->link,$brandId);
			$body          = $this->fm->validation($data['body']);
			$body          = mysqli_real_escape_string($this->db->link,$body);
			$price         = $this->fm->validation($data['price']);
			$price         = mysqli_real_escape_string($this->db->link,$price);
			$type          = $this->fm->validation($data['type']);
			$type          = mysqli_real_escape_string($this->db->link,$type);


			$permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

                if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
                    $msg = "<span class='error'>Field must not be empty ! !</span>";
                    return $msg;

                } else{

                if (!empty($file_name )) {
                   
                     if ($file_size >1048567) {
                         $msg = "<span class='error'>Image Size should be less then 1MB!</span>";
                         return $msg;

                    } elseif (in_array($file_ext, $permited) === false) {

                         echo "<span class='error'>You can upload only:-"
                         .implode(', ', $permited)."</span>";

                        } else{

                            move_uploaded_file($file_temp, $uploaded_image);
                            
                            $query ="UPDATE tbl_product
                                    SET
                                    productName     = '$productName',
                                    catId   = '$catId',
                                    brandId    = '$brandId',
                                    body   = '$body',
                                    price  = '$price',
                                    image    = '$uploaded_image',
                                    type  = '$type'
                                    WHERE productId= '$id'"; 
                            $updated_row = $this->db->update($query);
                            if ($updated_row) {

                             $msg = "<span class='success'>Product Updated Successfully.
                             </span>";
                             return $msg;

                        } else {

                         echo "<span class='error'>Product Not Updated !</span>";
                        }
                    }

                } else{

                    $query ="UPDATE tbl_product
                                    SET
                                    productName     = '$productName',
                                    catId   = '$catId',
                                    brandId    = '$brandId',
                                    body   = '$body',
                                    price  = '$price',
                                    type  = '$type'
                                    WHERE productId= '$id'";  
                            $updated_row = $this->db->update($query);
                            if ($updated_row) {

                             $msg = "<span class='success'>Post Updated Successfully.
                             </span>";
                             return $msg;

                        } else {

                         $msg = "<span class='error'>Post Not Updated !</span>";
                         return $msg;
                        }
            }

			}
		}

		public function prodDel($id){

		$query = "SELECT * FROM tbl_product WHERE productId='$id'";
        $getdata = $this->db->select($query);
        if ($getdata) {
        	while ($delimg = $getdata->fetch_assoc()) {
        		$dellink = $delimg['image'];
        		unlink($dellink);

        	}
        }


			$delquery ="DELETE FROM `tbl_product` WHERE productId='$id'";
			$delete_row = $this->db->delete($delquery);
			if ($delete_row) {
					$msg = "<span class='success'>Product Deleted Successfully</span>";
					return $msg;
				} else {
					
					$msg = "<span class='error'>Product Not Deleted Successfully!</span>";
					return $msg;
				}
		}

        public function getFeatureProduct(){
            $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }


        public function getNewProduct(){
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSingleProduct($id){
            $query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
            FROM tbl_product
            INNER JOIN tbl_category
            ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand
            ON tbl_product.brandId = tbl_brand.brandId
            AND tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }


        public function getLatestIphone(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLatestSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLatestCanon(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLatestAccer(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function productByCat($id){

            $catId         = mysqli_real_escape_string($this->db->link,$id);
            $query = "SELECT * FROM tbl_product WHERE catId='$catId'";
            $result = $this->db->select($query);
            return $result;
        }


        public function getAllCatProduct(){
            $query = "SELECT * FROM tbl_product WHERE catId='17' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertCompareData($cmprid, $cmrId){
            $cmrId = mysqli_real_escape_string($this->db->link,$cmrId);
            $productId = mysqli_real_escape_string($this->db->link,$cmprid);

            $query = "SELECT * FROM tbl_product WHERE productId ='$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            if ($result) {
                
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $price = $result['price'];
                    $image = $result['image'];

                    $chquery ="SELECT * FROM tbl_compare WHERE productId = '$productId' AND cmrId = '$cmrId'";
                    $getPro  =$this->db->select($chquery);

            if ($getPro) {
                $msg = "<span class='success'>Already Added!</span>";
                    return $msg;
            } else{

                    $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) 
                        VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
                    $inserted_rows = $this->db->insert($query);

                    if ($inserted_rows) {
                        $msg = "<span class='success'>Added to Compare Successfully</span>";
                    return $msg;
                    } else {
                    
                    $msg = "<span class='error'>Not Added Successfully!</span>";
                    return $msg;
                }
            }

            }


        }

        public function insertWlistData($cmprid, $cmrId){
            $cmrId = mysqli_real_escape_string($this->db->link,$cmrId);
            $productId = mysqli_real_escape_string($this->db->link,$cmprid);

            $query = "SELECT * FROM tbl_product WHERE productId ='$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            if ($result) {
                
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $price = $result['price'];
                    $image = $result['image'];

                    $chquery ="SELECT * FROM tbl_wlist WHERE productId = '$productId' AND cmrId = '$cmrId'";
                    $getPro  =$this->db->select($chquery);

            if ($getPro) {
                $msg = "<span class='success'>Already Added!</span>";
                    return $msg;
            } else{

                    $query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) 
                        VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
                    $inserted_rows = $this->db->insert($query);

                    if ($inserted_rows) {
                        $msg = "<span class='success'>Added to Wlist Successfully</span>";
                    return $msg;
                    } else {
                    
                    $msg = "<span class='error'>Not Added Successfully!</span>";
                    return $msg;
                }
            }

            }


        }





}
?>