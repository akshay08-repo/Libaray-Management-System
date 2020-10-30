<?php
session_start();
if (isset($_SESSION["ssn"])) echo "";
else header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <style>
        form{
            margin-top: 50px;
            
            
        }
        #home{
            height: 300px;;
            
        }
        #profile{
            margin: auto;
        }
    .border {
        padding-top: 25px;
        padding-bottom: 25px;
    border-width:2px !important;
}
        #home_heading
        {
            text-align: center;
            padding-top: 15%;
            
        }

    </style>
    	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script>
	$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
	</script>
</head>
<body style="background-color:#c2dde6">
<div class="container">
<nav style="background-color:#7A9D96">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color:#d1bfa7">
  <li class="nav-item pl-5">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add Member</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Add Book</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" id="borrow-tab" data-toggle="tab" href="#borrow" role="tab" aria-controls="borrow" aria-selected="false">Borrow Book</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false">Return Book</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" id="gen-tab" data-toggle="tab" href="#gen" role="tab" aria-controls="gen" aria-selected="false">Generate Card</a>
  </li>
     <li class="nav-item">
    <a class="nav-link" id="renew-tab" data-toggle="tab" href="#renew" role="tab" aria-controls="renew" aria-selected="false">Renew Card</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" id="logout-tab"  href="logout.php">Logout</a>
  </li>
</ul>
   <div class="tab-content" id="myTabContent">
   
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  
  
  <h1 id="home_heading">This is the Landing Page of the Libaray Management</h1>
  
  
  </div>
  <div class="tab-pane fade mx-auto py-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">        <form action="functions_lm.php" class="border rounded col-md-5 mx-auto   pl-5  " enctype="multipart/form-data" method="POST" style="background-color:#bccbde" >
           <legend>Add Member</legend>
            
                <div class="form-group">
                    <label for="ssn" class=" "style="display: inline-block ">SSN:</label>
                <input type="text" class="form-control w-75 " id="ssn" name="ssn" placeholder="Enter SSN">
                </div>
                
                <div class="form-group">
                    <label for="phn">Phone Number:</label>
                    <input type="text" class="form-control w-75" name="phn" id="phn" placeholder="Enter Phonenumber">
                    
                </div>
                <div class="form-group">Type:</div>
                <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" id="student"  name="type" value="student">
  <label class="form-check-label mx-2" for="student">Student</label>
  <input class="form-check-input" type="radio" name="type" id="professor" value="professor">
  <label class="form-check-label" for="professor">Professor</label>
</div>


			 <div class="student box" class="form-group " style="display:none">
			       <label for="studentAddr" class="my-2">Home Address:</label>
                    <input type="text" class="form-control w-75" id="homeadr" name="homeadr" placeholder="Enter Address">
			     
			 </div>
    <div class="professor box"style="display:none">
     <label for="professorAddr" class="my-2">Campus Address:</label>
                    <input type="text" class="form-control w-75" id="phn" name="campusadr" placeholder="Enter Address">
    </div>


  <div class="form-group ">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_mem">Submit</button>
  </div>
        </form> 
  </div>
  <div class="tab-pane fade mx-auto py-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <form action="functions_lm.php" class="border rounded col-md-5 mx-auto   pl-5  " enctype="multipart/form-data" method="POST" style="background-color:#bccbde">
            <legend>Add Book</legend>
            <div class="form-group">
                 <label for="isbn" class=" "style="display: inline-block ">ISBN:</label>
                <input type="text" class="form-control w-75 " id="isbn" name="isbn" placeholder="Enter ISBN code" required>
                
            </div>
				 <div class="form-group">
                <label for="title" class=" "style="display: inline-block ">Title:</label>
                
                <input type="text" class="form-control w-75 " id="title" name="title" placeholder="Enter title " required>
                
                
            </div>
            		 <div class="form-group">
                <label for="author" class=" "style="display: inline-block ">Author:</label>
                
                <input type="text" class="form-control w-75 " id="author" name="author" placeholder="Enter author" required>
                
                
            </div>
            <div class="form-group">
                <label for="edition" class=" "style="display: inline-block ">Edition:</label>
                
                <input type="text" class="form-control w-75 " id="edition" name="edition" placeholder="Enter edition number" required>
                
                
            </div>
             <div class="form-group">
                <label for="subject" class=" "style="display: inline-block ">Subject Area:</label>
                
                <input type="text" class="form-control w-75 " id="subject" name="subject" placeholder="Enter subject" required>
                
                
            </div>
				<div class="form-group">
				    
				Is the book present in the library catalouge?
				</div>
			<div class="form-check form-check-inline">
			 <input class="form-check-input" type="radio" name="library" id="in_library" value="in_library" required>
         <label class="form-check-label mx-2" for="in_library">In Library</label>
			  <input class="form-check-input" type="radio" name="library" id="to_acquire" value="to_acquire" required=""> 
			  
			  <label class="form-check-label" for="to_acquire">To Acquire</label>   
			</div>
				
				
				<div class="in_library cannot_lend can_lend box"
           class="form-group " style="display:none">
            <label for="desc" class="my-2">Description:</label>
					<input class="form-control w-75" type="text" name="description" id="description" placeholder="Enter Description of book" >
					<label for="desc" class="my-2">Binding:</label>
					<input type="text"
					class="form-control w-75" name="binding" id="binding" placeholder="Enter binding of book" >
					<div class="form-group">Can be lent or not?</div>
					<div class="form-check form-check-inline">
					 
					<input type="radio" 
					class="form-check-input"name="lent" id="can_lend" value="can_lend" > 
					 <label class="form-check-label mx-2" for="lend">Can Lend</label>
					<input type="radio" 
                   class="form-check-input" name="lent" id="cannot_lend" value="cannot_lend" > 
                   <label class="form-check-label mx-2" for="cannotlend">Cannot Lend</label>
                    </div>
                    <div class="form-group"
                    >
					<label class="form-check-label my-2" for="count">Total Count:</label>
					<input type="text" name="total_count"
					class="form-control w-75" id="total_count" placeholder="Enter No of copies of book" >
					</div>
					<div class="cannot_lend box" class="form-group " >
					<label for="studentAddr" class="my-2">Type of Book:</label>
						
						<input type="text" name="type" id="type"
						class="form-control w-75" placeholder="Enter type of book" >
						

					</div>

				</div>
				<div class="to_acquire box"
				class="form-group "  style="display:none">
					 <label for="studentAddr" class="my-2">Reason</label>
					<input type="text" 
					class="form-control w-75" name="reason" id="reason" placeholder="Enter your Reason" >
					
				</div>

				<div class="form-group ">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_book">Submit</button>
  </div>

			</form></div>
			<div class="tab-pane fade mx-auto py-5" id="borrow" role="tabpanel" aria-labelledby="borrow-tab">
			    
			  
			<form action="functions_lm.php" 
			class="border rounded col-md-5 mx-auto   pl-5  "  enctype="multipart/form-data" method="POST"style="background-color:#bccbde">
			<legend>Borrow Book</legend>
			<div class="form-group">
			    <label for="mem_ssn" class=" "style="display: inline-block ">Member SSN</label>
			    <input type="text" 
			    class="form-control w-75 "name="ssn" placeholder="Enter member ssn" required>
			</div>
				<div class="form-group">
				     <label for="mem_ssn" class=" "style="display: inline-block ">Book ISBN</label>
				     
				     <input type="text" 
				     class="form-control w-75"
				     name="isbn" placeholder="Enter book isbn" required>
				</div>
				
				
				
				<div class="form-group">
				    <label for="brw_days" class=" "style="display: inline-block ">Borrow for No of days</label>
				    <input type="text"
				    class="form-control w-75" name="days" placeholder="Number of days" required>
				</div>

				 <div class="form-group ">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_borrow">Submit</button>
  </div>

			</form>

		
			</div>
			<div class="tab-pane fade mx-auto py-5" id="return" role="tabpanel" aria-labelledby="return-tab">
			  	<form action="functions_lm.php" class="border rounded col-md-5 mx-auto   pl-5  " enctype="multipart/form-data" method="POST" style="background-color:#bccbde">
			  	<legend>Return Book</legend>
			  	<div class="form-group">
			    <label for="mem_ssn" class=" "style="display: inline-block ">Member SSN</label>
			    <input type="text" 
			    class="form-control w-75 "name="ssn" placeholder="Enter member ssn" required>
			</div>
				
				
					<div class="form-group">
				     <label for="mem_ssn" class=" "style="display: inline-block ">Book ISBN</label>
				     
				     <input type="text" 
				     class="form-control w-75"
				     name="isbn" placeholder="Enter book isbn" required>
				</div>
				<div class="form-group">
				    <label for="issuedate" class=" "style="display: inline-block ">Issue Date</label>
				    <input type="text" class="form-control w-75" name="issue_date" placeholder="YYYY-MM-DD" required>

				</div>

<div class="form-group">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_return">Submit</button>
  </div>

			</form>  
			    
			</div>
			<div class="tab-pane fade mx-auto py-5" id="gen" role="tabpanel" aria-labelledby="gen-tab">
			    <form action="functions_lm.php" class="border rounded col-md-5 mx-auto   pl-5  " enctype="multipart/form-data" method="POST" style="background-color:#bccbde">
			    <legend>Generate Card</legend>
			    <div class="form-group">
			        <label for="ssn" class=" "style="display: inline-block ">SSN</label>
			        <input type="text" name="ssn" class="form-control w-75" placeholder="Enter your ssn" required>
			    </div>
				
<div class="form-group">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_gen">Submit</button>
                    </div>
				

			</form>
			</div>
			<div class="tab-pane fade mx-auto py-5" id="renew" role="tabpanel" aria-labelledby="renew-tab">

<form action="functions_lm.php" class="border rounded col-md-5 mx-auto   pl-5  "  enctype="multipart/form-data" method="POST" style="background-color:#bccbde">
            <legend>Renew Card</legend>
            <div class="form-group">
                 <label for="ssn" class=" "style="display: inline-block ">SSN</label>
                 <input type="text" name="ssn" class="form-control w-75" placeholder="Enter member ssn" required>
            </div>
				

<div class="form-group">
      <button type="submit" class="btn btn-primary  mt-2 " value="Submit" name="submit_renew">Submit</button>
                    </div>

			</form>
</div>
</div>
    
</nav>

</div>

</body>
</html>