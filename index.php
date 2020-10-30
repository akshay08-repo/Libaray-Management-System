
  <?php
   session_start();
   //if (isset($_SESSION["ssn"])) header("Location: home.php");
   ?>

  <html>
   <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   </head>
   <body style="background-color: #d4d4dc" >
     <div class = "container mx-auto py-5 shadow p-3 mb-5 rounded" style="background-color:#acb7ae">
      <h1 align = "center" style="padding-top: 50px;"><b> Library Database Management System </b></h1>
      <h2 align = "center" style="padding-top: 50px;"> Login</h2>
      <div align = "center " style="padding-top:40px;">

         <form id="login-form" name="login-form" action="login.php" method="post" >
           <div class="form-group col-4 mx-auto py-4 shadow p-3 mb-5 rounded " style="background-color:#e4decd">
    <label for="login-form-username">UserName</label>
            <input type="text" id="login-form-username" name="ssn" value="" placeholder="Enter User SSN"required/><br><br>
             <label for="login-form-password">Password</label>
            <input type="password" id="login-form-password" name="password" value="" placeholder="Enter Password"required/><br><br> 
            
            <button name="login-form-submit" value="login" class="btn btn-primary">Login</button>
             </div>
          </form>
      </div>
   
    </div> 

   </body>
</html>