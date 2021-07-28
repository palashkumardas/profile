<?php

include ('class/class.php');
$contactObj = new User();

// Insert Record in customer table
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $insertData = $contactObj->insertcontact($name,$email,$subject,$message);

if ($insertData) {
    echo '<div class="alert alert-success" role="alert">
    Your mail has sent!
  </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
    Something is going wrong!
  </div>';
}
}
?>