<?php
 	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php'); 
 ?>

<?php 

	/**
	 * 
	 */
	class Session
	{
		
		public static function init(){
			session_start();
		}

		public static function set($key , $val){
			$_SESSION[$key] = $val;
		}

		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			} else{
				return false;
			}
		}

		public static function checkSession(){
			self::init();
			if (self::get("adminlogin") == false) {
				self::destroy();
				header("locatin:login.php");
			}
		}

		public static function checkLogin(){
			self::init();
			if (self::get("adminlogin") != false) {
				header("locatin:index.php");
			}
		}

		public static function destroy(){
			session_destroy();
			header("location:login.php");
		}
	}


 ?>