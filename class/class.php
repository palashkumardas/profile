<?php
require('../admin/class/config.php');
class User extends Dbconfig
{
	protected $hostName;
	protected $userName;
	protected $password;
	protected $dbName;
	private $dbConnect = false;
	public function __construct()
	{
		if (!$this->dbConnect) {
			$database = new dbConfig();
			$this->hostName = $database->serverName;
			$this->userName = $database->userName;
			$this->password = $database->password;
			$this->dbName = $database->dbName;
			$conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
			if ($conn->connect_error) {
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			} else {
				$this->dbConnect = $conn;
			}
		}
	}
	// insert contact data 
    public function insertcontact($name, $email, $subject, $message){
    $query = "INSERT INTO  contact (`name`, `email`,`subject`, `message`)
        VALUES('$name','$email','$subject','$message')";
    $sql = $this->dbConnect->query($query);
    if ($sql) {
    return true;
    }else{
    return false;
    }   		    
	}
	
	// data fetch from home table
	public function showhomedata(){
	$sqlQuery="SELECT * FROM home ";
	$result = mysqli_query($this->dbConnect, $sqlQuery);	
	$userDetails = mysqli_fetch_assoc($result);
	return $userDetails;
	}
	// fetch about data 
	public function showaboutdata(){
	$sqlQuery="SELECT * FROM about ";
	$result = mysqli_query($this->dbConnect, $sqlQuery);	
	$userDetails = mysqli_fetch_assoc($result);
	return $userDetails;
	}
	// fetch fact data

	public function showfactData()
	{
	$sql = "SELECT * FROM facts";
	$query = $this->dbConnect->query($sql);
	$data = array();
	if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		$data[] = $row;
	}
	return $data;
	}else{
	return false;
	}
	}
// fetch testmonials  data

	public function showtestmonialData()
	{
	$sql = "SELECT * FROM testimonials";
	$query = $this->dbConnect->query($sql);
	$data = array();
	if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		$data[] = $row;
	}
	return $data;
	}else{
	return false;
	}
	}

				
	// fetch fact data 
	public function showservicesdata(){
	$sqlQuery="SELECT * FROM services ";
	$result = mysqli_query($this->dbConnect, $sqlQuery);	
	$userDetails = mysqli_fetch_assoc($result);
	return $userDetails;
	}
	// show skill data 
	public function showskillData()
 	{
	 $sql = "SELECT * FROM skills";
	 $query = $this->dbConnect->query($sql);
	 $data = array();
	 if ($query->num_rows > 0) {
	 while ($row = $query->fetch_assoc()) {
		 $data[] = $row;
	 }
	 return $data;
	 }else{
	 return false;
	 }
 	}

	// show cv data 
	public function showcvData()
 	{
	 $sql = "SELECT * FROM cv";
	 $query = $this->dbConnect->query($sql);
	 $data = array();
	 if ($query->num_rows > 0) {
	 while ($row = $query->fetch_assoc()) {
		 $data[] = $row;
	 }
	 return $data;
	 }else{
	 return false;
	 }
	 }
	 
	// show ed data 
	public function showedData()
	{
	$sql = "SELECT * FROM ed";
	$query = $this->dbConnect->query($sql);
	$data = array();
	if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		$data[] = $row;
	}
	return $data;
	}else{
	return false;
	}
	}
	// show exp data 
	public function showexpData()
	{
	$sql = "SELECT * FROM ex";
	$query = $this->dbConnect->query($sql);
	$data = array();
	if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		$data[] = $row;
	}
	return $data;
	}else{
	return false;
	}
	}






}