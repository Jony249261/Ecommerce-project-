<?php 

	$filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

 <?php 
 
 class Customer {
 	
 	private $db;
	private $fm;

		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();

		}

		public function customerRegistration($data){
			$name   = $this->fm->validation($data['name']);
			$name   = mysqli_real_escape_string($this->db->link,$name);

			$address         = $this->fm->validation($data['address']);
			$address         = mysqli_real_escape_string($this->db->link,$address);

			$city       = $this->fm->validation($data['city']);
			$city       = mysqli_real_escape_string($this->db->link,$city);

			$country          = $this->fm->validation($data['country']);
			$country          = mysqli_real_escape_string($this->db->link,$country);

			$zip         = $this->fm->validation($data['zip']);
			$zip         = mysqli_real_escape_string($this->db->link,$zip);

			$phone          = $this->fm->validation($data['phone']);
			$phone          = mysqli_real_escape_string($this->db->link,$phone);

			$email         = $this->fm->validation($data['email']);
			$email         = mysqli_real_escape_string($this->db->link,$email);

			$password          = $this->fm->validation($data['password']);
			$password          = mysqli_real_escape_string($this->db->link,md5($password));

			if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $password == "") {
                    $msg = "<span class='error'>Field must not be empty ! !</span>";
                    return $msg;

                }

                $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
                $mailchk = $this->db->select($mailquery);
                if($mailchk != false){
                	$msg = "<span class='error'>Email Already Exist ! !</span>";
                    return $msg;

                } else{
                        
                        $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, password) 
                        VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password')";
                        $inserted_rows = $this->db->insert($query);
                        if ($inserted_rows) {

                         $msg =  "<span class='success'>Registration Successfully.</span>";
                         return $msg;


                    }else {
                     $msg = "<span class='error'>Registration Not Successfully. !</span>";
                     return $msg;
                    }
                }

		}

		public function customerLogin($data){
			$email         = $this->fm->validation($data['email']);
			$email         = mysqli_real_escape_string($this->db->link,$email);

			$password          = $this->fm->validation($data['password']);
			$password          = mysqli_real_escape_string($this->db->link,md5($password));

			if (empty($email) || empty($password)) {
				$msg = "<span class='error'>Field must not be empty ! !</span>";
                    return $msg;
			}

			$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
			$result = $this->db->select($query);

			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("cuslogin", true);
				Session::set("cmrId", $value['id']);
				Session::set("cmrName", $value['name']);

				header("location:cart.php");

			} else{
				$msg = "<span class='error'>Email Or Password Not Matched ! !</span>";
                    return $msg;
			}
		}

		public function getUserData($id){
			$query = "SELECT * FROM tbl_customer WHERE id ='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function customerUpdate($data,$cmrId){
			$name   = $this->fm->validation($data['name']);
			$name   = mysqli_real_escape_string($this->db->link,$name);

			$address         = $this->fm->validation($data['address']);
			$address         = mysqli_real_escape_string($this->db->link,$address);

			$city       = $this->fm->validation($data['city']);
			$city       = mysqli_real_escape_string($this->db->link,$city);

			$country          = $this->fm->validation($data['country']);
			$country          = mysqli_real_escape_string($this->db->link,$country);

			$zip         = $this->fm->validation($data['zip']);
			$zip         = mysqli_real_escape_string($this->db->link,$zip);

			$phone          = $this->fm->validation($data['phone']);
			$phone          = mysqli_real_escape_string($this->db->link,$phone);

			$email         = $this->fm->validation($data['email']);
			$email         = mysqli_real_escape_string($this->db->link,$email);

			if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
                    $msg = "<span class='error'>Field must not be empty ! !</span>";
                    return $msg;

                } else{
                        
                        $query ="UPDATE tbl_customer
                                    SET
                                    name     = '$name',
                                    address   = '$address',
                                    city    = '$city',
                                    country  = '$country',
                                    zip    = '$zip',
                                    phone  = '$phone',
                                    email = '$email'
                                    WHERE id= '$cmrId'";
                        $inserted_rows = $this->db->update($query);
                        if ($inserted_rows) {

                         $msg =  "<span class='success'>Update Successfully.</span>";
                         return $msg;


                    }else {
                     $msg = "<span class='error'>Update Not Successfully. !</span>";
                     return $msg;
                    }
                }
		}

		public function Contact($data){
			$name   = $this->fm->validation($data['name']);
			$name   = mysqli_real_escape_string($this->db->link,$name);

			$phone          = $this->fm->validation($data['phone']);
			$phone          = mysqli_real_escape_string($this->db->link,$phone);

			$email         = $this->fm->validation($data['email']);
			$email         = mysqli_real_escape_string($this->db->link,$email);

			$body          = $this->fm->validation($data['body']);
			$body          = mysqli_real_escape_string($this->db->link,$body);

			if ($name == "" || $phone == "" || $email == "" || $body == "") {
                    $msg = "<span class='error'>Field must not be empty ! !</span>";
                    return $msg;

                } else{
                        
                        $query = "INSERT INTO tbl_contact(name,phone, email, body) 
                        VALUES('$name','$phone', '$email', '$body')";
                        $inserted_rows = $this->db->insert($query);
                        if ($inserted_rows) {

                         $msg = "<span class='success'>Message Sent Successfully.</span>";
                         return $msg;

                    }else {
                     $msg = "<span class='error'>Message Not Successfully. !</span>";
                     return $msg;
                    }
                }
		}

		public function viewMsg($id){
			$query = "SELECT * FROM tbl_contact WHERE id ='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		






	}

?>