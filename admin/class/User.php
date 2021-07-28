<?php
session_start();
require('config.php');
class User extends Dbconfig
{
	protected $hostName;
	protected $userName;
	protected $password;
	protected $dbName;
	private $userTable = 'user';
	private $homeTable='home';
	private $aboutTable='about';
	private $testmonialTable='testimonials';
	private $factTable='facts';
	private $resumeTable='cv';
	private $servicetable='services';
	private $skillstable='skills';
	private $portfoliotable='portfolio';
	private $timeTable='timeline';
	private $eduTable='ed';
	private $expTable='ex';
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
// Insert data with file
		public function insertData($name,$message,  $file)
		{	
			$allow = array('jpg', 'jpeg', 'png');
			$exntension = explode('.', $file['name']);
			$fileActExt = strtolower(end($exntension));
			$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
			$filePath = 'images/'.$fileNew; 
			
			if (in_array($fileActExt, $allow)) {
					if ($file['size'] > 0 && $file['error'] == 0) {
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
				$query = "INSERT INTO home(name, message,  picture)
					VALUES('$name','$message','$fileNew')";
				$sql = $this->dbConnect->query($query);
				if ($sql==true) {
				return true;
				}else{
				return false;
				}   		    
				}
			}
		}
		}

// Fetch home data

		public function displayData()
		{
			$sql = "SELECT * FROM home";
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

	// login status
	public function loginStatus()
	{
		if (empty($_SESSION["userid"])) {
			header("Location: login.php");
		}
	}
	// admin login
	public function Adminlogin()
	{
		$errorMessage = '';
		if (!empty($_POST["login"]) && $_POST["loginId"] != '' && $_POST["loginPass"] != '') {
			$loginId = $_POST['loginId'];
			$password = md5($_POST['loginPass']);
			if (isset($_COOKIE["loginPass"]) && $_COOKIE["loginPass"] == $password) {
				$password = $_COOKIE["loginPass"];
			} else {
				$password = ($password);
			}
			$sqlQuery = "SELECT * FROM " . $this->userTable . " 
				WHERE email='" . $loginId . "' AND password='" . $password . "' AND type = 'admisnistrator'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery);
			$isValidLogin = mysqli_num_rows($resultSet);
			if ($isValidLogin) {
				if (!empty($_POST["remember"]) && $_POST["remember"] != '') {
					setcookie("loginId", $loginId, time() + (10 * 365 * 24 * 60 * 60));
					setcookie("loginPass",	$password,	time() + (10 * 365 * 24 * 60 * 60));
				} else {
					$_COOKIE['loginId'] = '';
					$_COOKIE['loginPass'] = '';
				}
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["userid"] = $userDetails['id'];
				$_SESSION["name"] = $userDetails['first_name'];
				$_SESSION["role"] = $userDetails['type'];
				header("location: dashboard.php");
			} else {
				$errorMessage = "Invalid login!";
			}
		} else if (!empty($_POST["loginId"])) {
			$errorMessage = "Enter Both user and password!";
		}
		return $errorMessage;
	}
// register
	public function register()
	{
		$message = '';
		if (!empty($_POST["register"]) && $_POST["email"] != '') {
			$sqlQuery = "SELECT * FROM " . $this->userTable . " 
				WHERE email='" . $_POST["email"] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$isUserExist = mysqli_num_rows($result);
			if ($isUserExist) {
				$message = "User already exist with this email address.";
			} else {
				$authtoken = $this->getAuthtoken($_POST["email"]);
				$insertQuery = "INSERT INTO " . $this->userTable . "(first_name, last_name, email, password, authtoken) 
				VALUES ('" . $_POST["firstname"] . "', '" . $_POST["lastname"] . "', '" . $_POST["email"] . "', '" . md5($_POST["passwd"]) . "', '" . $authtoken . "')";
				$userSaved = mysqli_query($this->dbConnect, $insertQuery);
				if ($userSaved) {
					$link = "<a href='http://".$_SERVER['SERVER_NAME']."/myself/verify.php?authtoken=" . $authtoken . "'>Verify Email</a>";
					$toEmail = $_POST["email"];
					$subject = "Verify email to complete registration";
					$msg = "Hi there, click on this " . $link . " to verify email to complete registration.";
					$msg = wordwrap($msg, 70);
					$headers = "From: info.palash27@gmail.com";
					if (mail($toEmail, $subject, $msg, $headers)) {
						$message = "Verification email send to your email address. Please check email and verify to complete registration.";
					}
				} else {
					$message = "User register request failed.";
				}
			}
		}
		return $message;
	}
	// authtoken
	public function getAuthtoken($email)
	{
		$code = md5(889966);
		$authtoken = $code . "" . md5($email);
		return $authtoken;
	}
	// verify account
	public function verifyRegister()
	{
		$verifyStatus = 0;
		if (!empty($_GET["authtoken"]) && $_GET["authtoken"] != '') {
			$sqlQuery = "SELECT * FROM " . $this->userTable . " 
				WHERE authtoken='" . $_GET["authtoken"] . "'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery);
			$isValid = mysqli_num_rows($resultSet);
			if ($isValid) {
				$userDetails = mysqli_fetch_assoc($resultSet);
				$authtoken = $this->getAuthtoken($userDetails['email']);
				if ($authtoken == $_GET["authtoken"]) {
					$updateQuery = "UPDATE " . $this->userTable . " SET status = 'active'
						WHERE id='" . $userDetails['id'] . "'";
					$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
					if ($isUpdated) {
						$verifyStatus = 1;
					}
				}
			}
		}
		return $verifyStatus;
	}
	// user details
	public function userDetails () {
		$sqlQuery = "SELECT * FROM ".$this->userTable." 
			WHERE id ='".$_SESSION["userid"]."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails;
	}	
	// edit account
	public function editAccount()
	{
		$message = '';
		$updateQuery = "UPDATE " . $this->userTable . " 
			SET first_name = '" . $_POST["firstname"] . "', last_name = '" . $_POST["lastname"] . "', email = '" . $_POST["email"] . "', mobile = '" . $_POST["mobile"] . "' , designation = '" . $_POST["designation"] . "', gender = '" . $_POST["gender"] . "'
			WHERE id ='" . $_SESSION["userid"] . "'";
		$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
		if ($isUpdated) {
			$message = "Account details saved.";
		}
		return $message;
	}
	// reset password
	public function resetPassword()
	{
		$message = '';
		if ($_POST['email'] == '') {
			$message = "Please enter username or email to proceed with password reset";
		} else {
			$sqlQuery = "
				SELECT email 
				FROM " . $this->userTable . " 
				WHERE email='" . $_POST['email'] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			if ($numRows) {
				$user = mysqli_fetch_assoc($result);
				$authtoken = $this->getAuthtoken($user['email']);
				$link = "<a href='https://".$_SERVER['SERVER_NAME']."/adminrole/reset_password.php?authtoken=" . $authtoken . "'>Reset Password</a>";
				$toEmail = $user['email'];
				$subject = "Reset your password";
				$msg = "Hi there, click on this " . $link . " to reset your password.";
				$msg = wordwrap($msg, 70);
				$headers = "From: info@palash27.com";
				if (mail($toEmail, $subject, $msg, $headers)) {
					$message =  "Password reset link send. Please check your mailbox to reset password.";
				}
			} else {
				$message = "No account exist with entered email address.";
			}
		}
		return $message;
	}
	// change password
	public function savePassword()
	{
		$message = '';
		if ($_POST['password'] != $_POST['cpassword']) {
			$message = "Password does not match the confirm password.";
		} else if ($_POST['authtoken']) {
			$sqlQuery = "
				SELECT email, authtoken 
				FROM " . $this->userTable . " 
				WHERE authtoken='" . $_POST['authtoken'] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			if ($numRows) {
				$userDetails = mysqli_fetch_assoc($result);
				$authtoken = $this->getAuthtoken($userDetails['email']);
				if ($authtoken == $_POST['authtoken']) {
					$sqlUpdate = "
						UPDATE " . $this->userTable . " 
						SET password='" . md5($_POST['password']) . "'
						WHERE email='" . $userDetails['email'] . "' AND authtoken='" . $authtoken . "'";
					$isUpdated = mysqli_query($this->dbConnect, $sqlUpdate);
					if ($isUpdated) {
						$message = "Password saved successfully. Please <a href='login.php'>Login</a> to access account.";
					}
				} else {
					$message = "Invalid password change request.";
				}
			} else {
				$message = "Invalid password change request.";
			}
		}
		return $message;
	}
	// save adminpassword
	public function saveAdminPassword()
	{
		$message = '';
		if ($_POST['password'] && $_POST['password'] != $_POST['cpassword']) {
			$message = "Password does not match the confirm password.";
		} else {
			$sqlUpdate = "
				UPDATE " . $this->userTable . " 
				SET password='" . md5($_POST['password']) . "'
				WHERE id='" . $_SESSION['adminUserid'] . "' AND type='administrator'";
			$isUpdated = mysqli_query($this->dbConnect, $sqlUpdate);
			if ($isUpdated) {
				$message = "Password saved successfully.";
			}
		}
		return $message;
	}
// total users
	public function totalUsers($status)
	{
		$query = '';
		if ($status) {
			$query = " AND status = '" . $status . "'";
		}
		$sqlQuery = "SELECT * FROM " . $this->userTable . " 
		WHERE id !='" . $_SESSION["userid"] . "' $query";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}

	// personal data 
	public function personalData($title,$message,$webaddress,$age,$conclusion){
		$query = "INSERT INTO about (title,message,url,age,conclusion)
					VALUES('$title','$message','$webaddress','$age','$conclusion')";
				$sql = $this->dbConnect->query($query);
				if ($sql==true) {
				return true;
				}else{
				return false;
				}   		    
				}
	 
	// Fetch about data

	public function showpersonData()
	{
		$sql = "SELECT * FROM about";
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

// insert skill data
		public function skillData($title, $count){
		$query = "INSERT INTO skills (`title`, `count`)
				VALUES('$title','$count')";
			$sql = $this->dbConnect->query($query);
			if ($sql==true) {
			return true;
			}else{
			return false;
			}   		    
			}
 // fetch skills data
 
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
// insert fact information
	public function factData($fact, $count){
	$query = "INSERT INTO facts (`fact_name`, `count`)
			VALUES('$fact','$count')";
		$sql = $this->dbConnect->query($query);
		if ($sql==true) {
		return true;
		}else{
		return false;
		}   		    
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

// Insert data testimonial info
		public function addtestimonialData($name,$designation,$message,$file)
		{	
		$allow = array('jpg', 'jpeg', 'png');
		$exntension = explode('.', $file['name']);
		$fileActExt = strtolower(end($exntension));
		$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
		$filePath = 'images/'.$fileNew; 
		
		if (in_array($fileActExt, $allow)) {
				if ($file['size'] > 0 && $file['error'] == 0) {
				if (move_uploaded_file($file['tmp_name'], $filePath)) {
			$query = "INSERT INTO testimonials(name, designation, content, picture)
				VALUES('$name','$designation','$message','$fileNew')";
			$sql = $this->dbConnect->query($query);
			if ($sql==true) {
			return true;
			}else{
			return false;
			}   		    
			}
			}
			}
		}

// fetch fact data

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
			
	// insert cv personal information
		public function cvData($title,$message,$address,$phone){
		$query = "INSERT INTO  cv (`pname`, `pmessage`,`pcity`, `pphone`)
			VALUES('$title','$message','$address','$phone')";
		$sql = $this->dbConnect->query($query);
		if ($sql==true) {
		return true;
		}else{
		return false;
		}   		    
		}
	// insert ed information
		public function edData($title,$school,$duration,$message){
			$query = "INSERT INTO  ed (`ename`, `etime`,`eschool`, `emessage`)
				VALUES('$title','$duration','$school','$message')";
			$sql = $this->dbConnect->query($query);
			if ($sql==true) {
			return true;
			}else{
			return false;
			}   		    
			}
	// insert ed information
		public function exData($title,$duration,$org,$duty){
		$query = "INSERT INTO  ex (`exname`, `extime`,`eorg`, `eduty`)
			VALUES('$title','$duration','$org','$duty')";
		$sql = $this->dbConnect->query($query);
		if ($sql==true) {
		return true;
		}else{
		return false;
		}   		    
		}
	// insert service information
		public function serviceData($name,$content,$sname,$scontent,$tname,$tcontent){
		$query = "INSERT INTO  services (`name`, `content`,`sname`, `scontent`,`tname`, `tcontent`)
			VALUES('$name','$content','$sname','$scontent','$tname','$tcontent')";
		$sql = $this->dbConnect->query($query);
		if ($sql==true) {
		return true;
		}else{
		return false;
		}   		    
		}
		
// fetch service data

		public function showserviceData()
		{
		$sql = "SELECT * FROM services";
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
		// Insert portfolio with file
		public function addportfolioData($file)
		{	
			$allow = array('jpg', 'jpeg', 'png');
			$exntension = explode('.', $file['name']);
			$fileActExt = strtolower(end($exntension));
			$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
			$filePath = 'images/'.$fileNew; 
			
			if (in_array($fileActExt, $allow)) {
					if ($file['size'] > 0 && $file['error'] == 0) {
					if (move_uploaded_file($file['tmp_name'], $filePath)) {
				$query = "INSERT INTO portfolio(image)
					VALUES('$fileNew')";
				$sql = $this->dbConnect->query($query);
				if ($sql==true) {
				return true;
				}else{
				return false;
				}   		    
				}
			}
		}
		}
		
		// fetch service data

		public function showportfolioData()
		{
		$sql = "SELECT * FROM portfolio";
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
	
// fetch user data

		public function ContactTable()
		{
		$sql = "SELECT * FROM contact";
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
		
// delete home data
		public function homedelete(){
			$message='';
			$sql="DELETE FROM home WHERE id ='" . $_GET["id"] . "'";
			$query= $this->dbConnect->query($sql);
			if($query){
				$message="You have deleted..";
			}else{
				$message="You have failed..";

			}
			return $message;
		}
// delete personal info
		public function aboutdelete(){
			$message='';
			$sql="DELETE FROM about WHERE id ='" . $_GET["id"] . "'";
			$query= $this->dbConnect->query($sql);
			if($query){
				$message="You have deleted..";
			}else{
				$message="You have failed..";

			}
			return $message;
		}
// delete skill info
			public function skillsdelete(){
				$message='';
				$sql="DELETE FROM skills WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
					$message="You have deleted..";
				}else{
					$message="You have failed..";

				}
				return $message;
			}

// delete fact info
		public function factsdelete(){
			$message='';
			$sql="DELETE FROM facts WHERE id ='" . $_GET["id"] . "'";
			$query= $this->dbConnect->query($sql);
			if($query){
				$message="You have deleted..";
			}else{
				$message="You have failed..";

			}
			return $message;
		}

// delete testmonial info
		public function testimonialsdelete(){
			$message='';
			$sql="DELETE FROM testimonials WHERE id ='" . $_GET["id"] . "'";
			$query= $this->dbConnect->query($sql);
			if($query){
				$message="You have deleted..";
			}else{
				$message="You have failed..";

			}
			return $message;
		}
// delete resume info
			public function resumedelete(){
				$message='';
				$sql="DELETE FROM cv WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
					$message="You have deleted..";
				}else{
					$message="You have failed..";

				}
				return $message;
			}

// delete service info
			public function servicesdelete(){
				$message='';
				$sql="DELETE FROM services WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
					$message="You have deleted..";
				}else{
					$message="You have failed..";

				}
				return $message;
			}
// delete portfolio info
			public function portfoliodelete(){
				$message='';
				$sql="DELETE FROM portfolio WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
					$message="You have deleted..";
				}else{
					$message="You have failed..";

				}
				return $message;
			}

// fetch home data for update
			public function updatehome(){
				$sqlQuery="SELECT * FROM home WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
			}


// fetch personal data for update
			public function updatepersonal(){
				$sqlQuery="SELECT * FROM about WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
			}

// personal edit 
			public function editpersonal()
			{
				$message = '';
				$updateQuery = "UPDATE " . $this->aboutTable . " 
				SET title = '" . $_POST["title"] . "', message = '" . $_POST["message"] . "', url = '" . $_POST["url"] . "', age = '" . $_POST["age"] . "', conclusion = '" . $_POST["conclusion"] . "'
				WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
			}
			//fact  data 
			public function updatefact(){
				$sqlQuery="SELECT * FROM facts WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
			}

			public function editfact()
			{
				$message = '';
				$updateQuery = "UPDATE " . $this->factTable . " 
					SET fact_name = '" . $_POST["fact"] . "', count = '" . $_POST["range"] . "'
					WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
			}
		
			//   resume data fetch
			public function updateresume(){
				$sqlQuery="SELECT * FROM cv WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
			}
			// update cv data 
			public function editcv()
			{
				$message = '';
				$updateQuery = "UPDATE " . $this->resumeTable . " 
					SET pname= '" . $_POST["title"] . "', pmessage = '" . $_POST["summary"] . "', pcity = '" . $_POST["city"] . "', pphone = '" . $_POST["phone"] . "'
					WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
			}
			//   service data fetch
				public function updateservice(){
				$sqlQuery="SELECT * FROM services WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
				}
			// update service data
				public function editservice()
				{
				$message = '';
				$updateQuery = "UPDATE " . $this->servicetable . " 
					SET name= '" . $_POST["name"] . "', content = '" . $_POST["content"] . "', sname = '" . $_POST["sname"] . "', scontent = '" . $_POST["scontent"] . "', tname = '" . $_POST["tname"] . "', tcontent = '" . $_POST["tcontent"] . "'
					WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
				}
				// contact data delete
				public function contactdelete(){
				$message='';
				$sql="DELETE FROM contact WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
					$message="You have deleted..";
				}else{
					$message="You have failed..";
	
				}
				return $message;
				}
			//   skill data fetch
					public function updateskill(){
					$sqlQuery="SELECT * FROM skills WHERE id='". $_GET['id']."'";
					$result = mysqli_query($this->dbConnect, $sqlQuery);	
					$userDetails = mysqli_fetch_assoc($result);
					return $userDetails;
				}

				public function editskill()
				{
					$message = '';
					$updateQuery = "UPDATE " . $this->skillstable . " 
						SET title= '" . $_POST["title"] . "', count	='". $_POST["count"]."'
						WHERE id ='" . $_GET["id"] . "'";
					$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
					if ($isUpdated) {
						$message = "Information has updated.";
					}
					return $message;
				}
			// portfolio

				public function updateportfolio(){
					$sqlQuery="SELECT * FROM portfolio WHERE id='". $_GET['id']."'";
					$result = mysqli_query($this->dbConnect, $sqlQuery);	
					$userDetails = mysqli_fetch_assoc($result);
					return $userDetails;
				}
// edit  portfolio with file
					public function editport()
					{
						$message = '';
						$allow = array('jpg', 'jpeg', 'png');
						$exntension = explode('.', $file['name']);
						$fileActExt = strtolower(end($exntension));
						$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
						$filePath = 'images/'.$fileNew; 
			
						if (in_array($fileActExt, $allow)) {
						if ($file['size'] > 0 && $file['error'] == 0) {
						if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$updateQuery = "UPDATE " . $this->portfoliotable . " 
							SET name= '" . $_POST["title"] . "', image = '" . $_FILES["image"] . "'
							WHERE id ='" . $_GET["id"] . "'";
						$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
						if ($isUpdated) {
							$message = "Information has updated.";
						}
						}
						}
						}
						return $message;
					}

			// home data update code
					public function edithome()
				{
					$message = '';
					$updateQuery = "UPDATE " . $this->homeTable . " 
						SET name= '" . $_POST["name"] . "', message = '" . $_POST["message"] . "'
						WHERE id ='" . $_GET["id"] . "'";
					$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
					if ($isUpdated) {
						$message = "Information has updated.";
					}
					return $message;
				}
				
				// home data image
				public function homeimg($id,$file)
				{	
					$allow = array('jpg', 'jpeg', 'png');
					$exntension = explode('.', $file['name']);
					$fileActExt = strtolower(end($exntension));
					$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
					$filePath = 'images/'.$fileNew; 
					
					if (in_array($fileActExt, $allow)) {
							if ($file['size'] > 0 && $file['error'] == 0) {
							if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$query = "UPDATE home SET picture = '$fileNew' WHERE id = '$id'";
						$sql = $this->dbConnect->query($query);
						if ($sql==true) {
						return true;
						}else{
						return false;
						}   		    
						}
					}
				}
				}	
				// update testimonials
					public function updatetest(){
					$sqlQuery="SELECT * FROM testimonials WHERE id='". $_GET['id']."'";
					$result = mysqli_query($this->dbConnect, $sqlQuery);	
					$userDetails = mysqli_fetch_assoc($result);
					return $userDetails;
				}	
				// testimonial
				public function edittest()
				{
					$message = '';
					$updateQuery = "UPDATE " . $this->testmonialTable . " 
						SET name= '" . $_POST["name"] . "', designation = '" . $_POST["designation"] . "', content	='". $_POST["message"]."'
						WHERE id ='" . $_GET["id"] . "'";
					$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
					if ($isUpdated) {
						$message = "Information has updated.";
					}
					return $message;
				}
				// testimonial image
				public function testimg($id,$file)
				{	
					$allow = array('jpg', 'jpeg', 'png');
					$exntension = explode('.', $file['name']);
					$fileActExt = strtolower(end($exntension));
					$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
					$filePath = 'images/'.$fileNew; 
					
					if (in_array($fileActExt, $allow)) {
							if ($file['size'] > 0 && $file['error'] == 0) {
							if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$query = "UPDATE testimonials SET picture = '$fileNew' WHERE id = '$id'";
						$sql = $this->dbConnect->query($query);
						if ($sql==true) {
						return true;
						}else{
						return false;
						}   		    
						}
					}
				}
				}	
			// portfolio update
				public function portimg($id,$file)
				{	
					$allow = array('jpg', 'jpeg', 'png');
					$exntension = explode('.', $file['name']);
					$fileActExt = strtolower(end($exntension));
					$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
					$filePath = 'images/'.$fileNew; 
					
					if (in_array($fileActExt, $allow)) {
							if ($file['size'] > 0 && $file['error'] == 0) {
							if (move_uploaded_file($file['tmp_name'], $filePath)) {
						$query = "UPDATE portfolio SET image= '$fileNew' WHERE id = '$id'";
						$sql = $this->dbConnect->query($query);
						if ($sql==true) {
						return true;
						}else{
						return false;
						}   		    
						}
					}
				}
				}	
				// timeline detail
					public function timelineDetails () {
					$sqlQuery = "SELECT * FROM  timeline";
					$result = mysqli_query($this->dbConnect, $sqlQuery);	
					$Details = mysqli_fetch_assoc($result);
					return $Details;
				}
				// fetch profile data
				public function userData()
				{
				$sql = "SELECT * FROM user";
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

				// fetch summary data
				public function showresumedata()
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
				// fetch education data
				public function showedudata()
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
				// fetch experience data
				public function showexpdata()
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
				// education data delete
				public function edudelete(){
				$message='';
				$sql="DELETE FROM ed WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
				$message="You have deleted..";
				}else{
				$message="You have failed..";
		
				}
				return $message;
				}
				// education data delete
				public function expdelete(){
				$message='';
				$sql="DELETE FROM ex WHERE id ='" . $_GET["id"] . "'";
				$query= $this->dbConnect->query($sql);
				if($query){
				$message="You have deleted..";
				}else{
				$message="You have failed..";
			
				}
				return $message;
				}
	
				// education data fetch
				public function updateedu(){
				$sqlQuery="SELECT * FROM ed WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
				}
				
				// experience data fetch
				public function updateexp(){
				$sqlQuery="SELECT * FROM ex WHERE id='". $_GET['id']."'";
				$result = mysqli_query($this->dbConnect, $sqlQuery);	
				$userDetails = mysqli_fetch_assoc($result);
				return $userDetails;
				}
				// update cv data 
				public function editedu()
				{
				$message = '';
				$updateQuery = "UPDATE " . $this->eduTable . " 
					SET ename= '" . $_POST["degree"] . "', etime = '" . $_POST["duration"] . "', eschool = '" . $_POST["inst"] . "', emessage = '" . $_POST["summary"] . "'
					WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
				}

				// update experience data 
				public function editexp()
				{
				$message = '';
				$updateQuery = "UPDATE " . $this->expTable . " 
					SET exname= '" . $_POST["designation"] . "', extime = '" . $_POST["duration"] . "', eorg = '" . $_POST["org"] . "', eduty = '" . $_POST["duty"] . "'
					WHERE id ='" . $_GET["id"] . "'";
				$isUpdated = mysqli_query($this->dbConnect, $updateQuery);
				if ($isUpdated) {
					$message = "Information has updated.";
				}
				return $message;
				}

}