<?php
	
class Database_api{
		private $db_hostname; 
		private $db_database; 
		private $db_username; 
		private $db_password;
		private $conn;
			
		public function __construct($database){
			$this->db_database = 'unaux_29275584_gola';
			$this->db_hostname = 'sql101.unaux.com';  
			$this->db_username = 'unaux_29275584'; 
			$this->db_password = 'sy48k1j5';
		}
/*---------------------------------------------------------------------------------*/		
		private function connect(){
			$this->conn = mysqli_connect($this->db_hostname, $this->db_username, $this->db_password, $this->db_database);
			if (mysqli_connect_errno()) {
  				echo "Failed to connect to MySQL: " . mysqli_connect_error();
 				exit;
 			}
		}
		private function disconnect(){
			mysqli_close($this->conn);
		}
		public function dbselect(){
			mysqli_select_db($this->conn,$this->db_database) or die("Unable to select database: ".mysqli_error($this->conn));
		}
		public function execute($query){
			$this->connect();
			$result = mysqli_query($this->conn,$query);
			$this->disconnect();
			return $result;
		}
/*----------------------------------------------------------------------------------*/
		public function authenticate($username,$password){
			$this->connect();
			$query = "SELECT * from user WHERE username='$username' AND password='$password'";
			$result = mysqli_query($this->conn,$query);
			if(mysqli_num_rows($result)==0){
				$this->disconnect();
				return false;
			}
			$row = array();
			$temp = mysqli_fetch_assoc($result);
			$row['uname'] = $temp['username'];
			$row['name'] = $temp['name'];
			$this->disconnect();
			return $row; //if 1 then it is valid else not valid
		}
  /*---------------------------------------------------------------------------*/
  		public function getpdf(){
			$this->connect();
			$query = "SELECT * from pdftb WHERE category!='hidden' ORDER BY id desc";
			$result = mysqli_query($this->conn,$query);
			$this->disconnect();
			return $result; //if 1 then it is valid else not valid
		}
 public function fetchallpdf(){
			$this->connect();
			$query = "SELECT * from pdftb ORDER BY id DESC";
			$result = mysqli_query($this->conn,$query);
			$this->disconnect();
			return $result;
		}
		
		public function changecategory($id){
			$this->connect();
			$query = "SELECT * from pdftb WHERE id=$id";
			$result = mysqli_query($this->conn,$query);
			$row = mysqli_fetch_assoc($result);
			//echo $id;
			if($row['category'] == "hidden"){
				$query = "UPDATE pdftb SET category='visible' WHERE id=$id";
			}
			else{
				$query = "UPDATE pdftb SET category='hidden' WHERE id=$id";
					
			}
			//echo $query;
			$result = mysqli_query($this->conn,$query);
			$this->disconnect();
			return $result;
		}
  
}	
?>