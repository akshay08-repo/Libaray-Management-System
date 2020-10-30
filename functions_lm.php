<?php
session_start();
if (isset($_SESSION["ssn"])) echo "";
else header("Location: index.php");

error_reporting(E_ERROR | E_PARSE);
include 'db_con.php';

if (isset($_POST['submit_mem'])){

	$ssn = $_POST[ssn];
    $phn= $_POST[phn];
    $type = $_POST[type];
	$campusadr = $_POST[campusadr];
	$homeadr = $_POST[homeadr];

    $sql = "SELECT * from library_member where SSN ='$ssn'";
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);


	if($rows > 0){
		echo '<script>alert("Member with ssn '.$ssn.' is already present in the database");window.location.href = "nav.php";</script>';
	}
    else
    {
        $sql="INSERT into library_member(SSN,Librarian_SSN,Phone_Number) values('$ssn','$_SESSION[ssn]','$phn')";
    
    
    	if (mysqli_query($conn, $sql)) {
			if (strcmp($type, "student") == 0) {
				$sql = "INSERT into student values ('$ssn','$homeadr')";
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("Member successfully added");window.location.href = "nav.php";</script>';
				}
    else{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
			}
			else{
				$sql = "INSERT into professor values ('$ssn','$campusadr')";
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("Member successfully added");window.location.href = "nav.php";</script>';
				}
				else{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
			}
			
		}
		else{
			echo "Error: "  . "<br>" . mysqli_error($conn);
		}
	}
}
if (isset($_POST['submit_book'])){
	

	$sql = "SELECT * from book where ISBN =".$_POST['isbn'];
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);

	if($rows > 0){
		echo '<script>alert("Book with ISBN '.$_POST['isbn'].' is already present in the database");window.location.href = "nav.php";</script>';
	}
	else{

		$sql = "INSERT into book values (".$_POST['isbn'].", '".$_POST['title']."','".$_POST['author']."','".$_POST['subject']."','".$_POST['subject']."',CURRENT_DATE(),".$_SESSION["ssn"].")";

		if (mysqli_query($conn, $sql)) {
			if (strcmp($_POST['library'], "in_library") == 0) {
				$sql = "INSERT into in_library values (".$_POST['isbn'].", '".$_POST['description']."', '".$_POST['binding']."')";
				if (mysqli_query($conn, $sql)) {
					if (strcmp($_POST['lent'], "can_lend") == 0) {
						$sql = "INSERT into can_be_issued values (".$_POST['isbn'].",".$_POST['total_count'].",0)";
						if (mysqli_query($conn, $sql)) {
							echo '<script>alert("Book successfully added to '.$_POST['library'].' and '.$_POST['lent'].' tables");window.location.href = "nav.php";</script>';
						}
						else{
							echo "Error: "  . "<br>" . mysqli_error($conn);
						}
						
					}
					else{
						$sql = "INSERT into cannot_be_issued values (".$_POST['isbn'].", '".$_POST['type']."', ".$_POST['total_count'].")";
						if (mysqli_query($conn, $sql)) {
							echo '<script>alert("Book successfully added to '.$_POST['library'].' and '.$_POST['lent'].' tables");window.location.href = "nav.php";</script>';
						}
						else{
							echo "Error: "  . "<br>" . mysqli_error($conn);
						}
					}
				}
				else{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}



			}
			else{
				$sql = "INSERT into to_acquire values (".$_POST['isbn'].", '".$_POST['reason']."')";
				if (mysqli_query($conn, $sql)) {
					echo '<script>alert("Book successfully added to '.$_POST['library'].' table");window.location.href = "nav.php";</script>';
				}
				else{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
			}
			
		}
		else{
			echo "Error: "  . "<br>" . mysqli_error($conn);
		}
	}


}
if (isset($_POST['submit_borrow'])){

	$ssn = $_POST[ssn];

	$sql = "SELECT * from professor where MEM_SSN =".$ssn;
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);


	if($rows > 0){
		$graceperiod = 14;
	}
	else{
		$graceperiod = 7;
	}

	$sql = "SELECT * from library_member where SSN =".$ssn;
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);

	if($rows > 0){
		$sql = "SELECT * from can_be_issued where Book_ISBN =".$_POST['isbn'];
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($result);

		if($rows > 0){
			$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$borrowed_count = $row_['Borrowed_count'];
			$avaliable_count = $row_['Availabilty_count'];
           
			if($avaliable_count > 0){

				$sql = "SELECT * from borrow where Book_ISBN =".$_POST['isbn']." AND Mem_SSN=".$ssn." AND Issue_date = CURRENT_DATE()";
				$result = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($result);

				if($rows > 0){
					echo '<script>alert("A person can borrow only one copy of a particular ISBN book on a particular day.");window.location.href = "nav.php";</script>';
				}
				else{
					$sql = "SELECT * from borrow where Mem_SSN=".$ssn." AND Returned_or_Not = 0";
					$result = mysqli_query($conn, $sql);
					$rows = mysqli_num_rows($result);

					if($rows < 5){
						$avaliable_count = $avaliable_count-1;
                        echo $avaliable_count;
						$borrowed_count = $borrowed_count+1;
						$sql = "UPDATE can_be_issued SET Availabilty_count =".$avaliable_count.", Borrowed_count=".$borrowed_count." WHERE Book_ISBN=".$_POST['isbn'];
						mysqli_query($conn, $sql);

						$sql = "INSERT into borrow values (".$ssn.", ".$_POST['isbn'].", ".$_SESSION["ssn"].", CURRENT_DATE(),DATE_ADD(CURRENT_DATE(), INTERVAL ".$_POST['days']." DAY),".$graceperiod.",  0, NULL, NULL)";

						if (mysqli_query($conn, $sql)) {

							$sql = "SELECT DATE_ADD(CURRENT_DATE(), INTERVAL ".$_POST['days']." DAY) as return_date, CURRENT_DATE() as issue_date";
							$result = mysqli_query($conn, $sql);
							$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
							echo '<script>alert("Book Borrowed successfully.\n\n#### Issue Receipt ####\nIssue Date is: '.$row_['issue_date'].'\nReturn Date is : '.$row_['return_date'].'");window.location.href = "nav.php";</script>';
						}
						else{
							echo "Error: "  . "<br>" . mysqli_error($conn);
						}
					}
					else{
						echo '<script>alert("Members are allowed to check out only 5 books at a time.");window.location.href = "nav.php";</script>';
					}
				}

			}
			else{
				echo '<script>alert("No copies of this book are left in the library. Please try for another edition or binding.");window.location.href = "nav.php";</script>';
			}

		}
		else{
			echo '<script>alert("Book might not be in the library or cannot be lend.");window.location.href = "nav.php";</script>';	
		}
	}
	else{
		echo '<script>alert("Member not present in library. Please add member first.");window.location.href = "nav.php";</script>';	
	}

}
if (isset($_POST['submit_return'])){

	$ssn = $_POST[ssn];
	$isbn = $_POST[isbn];
	$issue_date = $_POST[issue_date];



	$sql = "SELECT * from borrow where Mem_SSN =".$ssn." AND Book_ISBN=".$isbn." AND Issued_date='".$issue_date."' AND Returned_Or_Not=0";
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);

	if($rows > 0){
		$sql = "SELECT * from can_be_issued where Book_ISBN =".$_POST['isbn'];
		$result = mysqli_query($conn, $sql);
		$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$borrowed_count = $row_['Borrowed_Count'];
		$avaliable_count = $row_['Available_Count'];

		$avaliable_count = $avaliable_count+1;
		$borrowed_count = $borrowed_count-1;
		$sql = "UPDATE can_lend SET Availablity_count =".$avaliable_count.", Borrowed_count=".$borrowed_count." WHERE Book_ISBN=".$_POST['isbn'];
		mysqli_query($conn, $sql);

		$sql = "UPDATE borrow SET Returned_Or_Not = 1, Returned_By_SSN=".$_SESSION["ssn"].", Returned_on_date = CURRENT_DATE() where Mem_SSN =".$ssn." AND Book_ISBN=".$isbn." AND Issued_date='".$issue_date."'";

		if (mysqli_query($conn, $sql)) {
			$sql = "SELECT Issued_date, Expiry_date, Returned_on_date, DATEDIFF(Returned_on_date, Issued_date) as days_borrowed, DATEDIFF(Returned_on_date, Expiry_date) as days_returned from borrow where Mem_SSN =".$ssn." AND Book_ISBN=".$isbn." AND Issued_date='".$issue_date."'";
			$result = mysqli_query($conn, $sql);
			$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
			echo '<script>alert("Book Returned successfully.\n\n#### Return Receipt ####\nIssue Date is: '.$row_['Issued_date'].'\nDue Date is : '.$row_['Expiry_date'].'\nReturn Date is : '.$row_['Returned_on_date'].'\nNumber of Days Borrowed: '.$row_['days_borrowed'].'\nNumbers of days extra borrowed from actual: '.$row_['days_returned'].'");window.location.href = "nav.php";</script>';
		}
		else{
			echo "Error: "  . "<br>" . mysqli_error($conn);
		}
	}
	else{
		echo '<script>alert("Invalid borrowing details entered. Please check again.");window.location.href = "nav.php";</script>';
	}
}
if (isset($_POST['submit_gen'])){

	$ssn = $_POST[ssn];

	
	$sql = "SELECT * from library_member where SSN =".$ssn;
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);

	if($rows > 0){


		$sql = "SELECT * from library_member where SSN =".$ssn." and Card_number IS NULL";
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($result);

		if($rows > 0){
			$sql = "SELECT max(Card_number) as max_card_num from library_member";
			$result = mysqli_query($conn, $sql);
			$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$new_card_num = $row_['max_card_num']+1;

			$sql = "UPDATE library_member set Card_Issued_Librarian =".$_SESSION["ssn"].", Card_number=".$new_card_num.", Card_issued_on = CURRENT_DATE(), Card_expired_on = DATE_ADD(CURRENT_DATE(), INTERVAL 48 MONTH), Notice_Date = DATE_ADD(CURRENT_DATE(), INTERVAL 47 MONTH) WHERE SSN = ".$ssn;
			if (mysqli_query($conn, $sql)) {
				$sql = "SELECT * from library_member where SSN =".$ssn;
				$result = mysqli_query($conn, $sql);
				$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);

				echo '<script>alert("Card for member with ssn '.$ssn.' has been generated.\nCard Created  by librarian with ssn: '.$row_['Card_Issued_Librarian'].'\nCard Number: '.$row_['Card_number'].'\nNotice_Date: '.$row_['Notice_Date'].'\nExpiry Date: '.$row_['Card_expired_on'].'");window.location.href = "options.php";</script>';	
			 	  	
			}
			else{
			    echo "Error: "  . "<br>" . mysqli_error($conn);
			}

		}
		else{
			echo '<script>alert("Card for member with ssn '.$ssn.' is already generated.");window.location.href = "nav.php";</script>';	
		}






	}
	else{
		echo '<script>alert("Member with ssn '.$ssn.' is not found. please add it first.");window.location.href = "nav.php";</script>';
	}
	
}
if (isset($_POST['submit_renew'])){

	$ssn = $_POST[ssn];

	
	$sql = "SELECT * from library_member where SSN =".$ssn;
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);

	if($rows > 0){


		$sql = "SELECT * from library_member where SSN =".$ssn." and Card_number IS NULL";
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($result);

		if($rows > 0){
			echo '<script>alert("Card for member with ssn '.$ssn.' is not yet generated. Please first generate card.");window.location.href = "nav.php";</script>';
		}
		else{
			$sql = "SELECT * from library_member where SSN =".$ssn;
			$result = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($result);
			$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);

			$sql = "SELECT DATEDIFF(CURRENT_DATE(), '".$row_['Card_expired_on']."') as noofdays_for_expiry";
			$result = mysqli_query($conn, $sql);
			$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$days = $row_['noofdays_for_expiry'];
			if( $days < 0){
				$days = $days*(-1);
				echo '<script>alert("Card for member with ssn '.$ssn.' is not yet expired. Please come back after '.$days.' days");window.location.href = "nav.php";</script>';
			}
			else{
				$sql = "UPDATE library_member set Card_Issued_Librarian =".$_SESSION["ssn"].", Card_issued_on = CURRENT_DATE(), Card_expired_on = DATE_ADD(CURRENT_DATE(), INTERVAL 48 MONTH), Notice_Date = DATE_ADD(CURRENT_DATE(), INTERVAL 47 MONTH) WHERE SSN = ".$ssn;
				if (mysqli_query($conn, $sql)) {
					$sql = "SELECT * from library_member where SSN =".$ssn;
					$result = mysqli_query($conn, $sql);
					$row_ = mysqli_fetch_array($result,MYSQLI_ASSOC);

					echo '<script>alert("Card for member with ssn '.$ssn.' has been renewed.\nCard renewed  by librarian with ssn: '.$row_['Card_Created_By_SSN'].'\nCard Number(remains same): '.$row_['Card_Number'].'\nNew Notice_Date: '.$row_['Notice_Date'].'\nNew Expiry Date: '.$row_['Expiry_Date'].'");window.location.href = "nav.php";</script>';	
				 	  	
				}
				else{
				    echo "Error: "  . "<br>" . mysqli_error($conn);
				}
			}		
		}






	}
	else{
		echo '<script>alert("Member with ssn '.$ssn.' is not found. please add it first.");window.location.href = "addmember.php";</script>';
	}
	
	



}

?>
