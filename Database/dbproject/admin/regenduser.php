<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reg user Form</title>
    
    <!--  css -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- php/mysql code here -->
 <?php
     //this class for requirement 
     //Develop login page, no need to have separate login pages for each actor. For successful logins, redirect to 
     // actor’s home page.



error_reporting(0);
     require_once("../connection.php");
	
     if(isset($_POST['signup']) && $_POST['name']!=="")
		{
	    $username = $_POST['name'];
            $password = $_POST['pass'];
            $fname =  $_POST['fname'];
            $lname =  $_POST['lname'];
            $mstat =  $_POST['mstat'];  
			$b="insert into end_user values('$username','$password','$fname','$lname','$mstat')";
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
                    <div >
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST">
                            <div >
                                <label for="name"><i ></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div >
                                <label for="pass"><i></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div >
                                <label for="fname"><i ></i></label>
                                <input type="text" name="fname" id="fname" placeholder="First Name"/>
                            </div>
                            <div>
                                <label for="lname"><i></i></label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name"/>
                            </div>
                            <div class="container" >
                                <p>Please select military status:</p>
                                <input type="radio" id="PartTime" name="mstat" value="E">
                                <label for="E">E</label><br>
                                <input type="radio" id="contract" name="mstat" value="D">
                                <label for="D" >D</label><br>
                                <input type="radio" id="contract" name="mstat" value="C">
                                <label for="C">C</label><br>
                            </div>
                            
                            <div >
                                <input type="submit" name="signup" id="signup"  value="Register"/>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </section>


    </div>


</body>
</html>