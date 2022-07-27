<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>


    <!--  css -->
  //  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- php/mysql code here -->
<?php
 //this class for requirement 
     //Develop login page, no need to have separate login pages for each actor. For successful logins, redirect to 
     // actor’s home page.
     require_once("../connection.php");
     $sa="SELECT `cid` FROM company ORDER BY cid DESC LIMIT 1";
     $dx=mysqli_query($con,$sa);
     $h=mysqli_fetch_assoc($dx);
   
     $id=$h['cid'];
     $newid=$id+1;
     if(isset($_POST['signup']))
		{
            
            $username =  $_POST['name'];
            $address =  $_POST['address'];
            $phone =  $_POST['phone'];
            $b="insert into company values('$newid', '$username','$address','$phone')";
            $result = mysqli_query($con,$b);
       if($result)
			{
				
				header("location: ../index.php");
			}
        }
?>


<!-- end of php/mysql code -->
    <div class="main">
        <!-- Sign up form -->
        <section >
            <div class="container">
                <div >
                   <div>
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST">
                            <div >
                                <label for="name"><i ></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div >
                                <label for="address"><i></i></label>
                                <input type="home" name="address" id="address" placeholder="Your address"/>
                            </div>
                            <div >
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="number" name="phone" id="phone" placeholder="phone"/>
                            </div>
                            
                           
                            <div >
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
    </div>
                    
                </div>
            </div>
        </section>


    </div>


</body>
</html>