<?php
if (isset($_POST["ssn"])) echo "";
else header("Location: index.php");
$ssn = $_POST['ssn'];
$password =$_POST['password'];
echo $password;

include 'db_con.php';

  $result_ = mysqli_query($conn, "SELECT * FROM librarian where SSN='$ssn'AND password='$password'");
  $rows = mysqli_num_rows($result_);
  if($rows > 0){
  	session_start();
    $_SESSION['ssn'] = $ssn;
  	header("Location: nav.php");
  }else{
  	echo '<script>alert("librarian with ssn '.$ssn.' is not found");window.location.href = "index.php";</script>';
  	
  }



?>
