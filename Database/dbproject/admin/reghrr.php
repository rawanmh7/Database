<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reg. HR Form</title>


    <!-- Main css -->
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
	
     if(isset($_POST['submit'])&& $_POST['name']!=="")
		{
	    $username =  $_POST['name'];
            $password =  $_POST['pass'];
            $email =  $_POST['email'];
            $fname =  $_POST['fname'];
            $lname =  $_POST['lname'];
            $euser =  $_POST['euser'];   
            
			
			$b="insert into hrr values('$username','$password','$email','$fname','$lname','$euser' )";
			$result = mysqli_query($con,$b);
       if($result)
			{
				
				header("location: ../index.php");
			}else echo "ahaaaaaa fail! ";
        }
?>


<!-- end of php/mysql code -->
    <div class="main">
        <!-- Sign up form -->
        <section >
            <div class="container">
                <div>
                    <div>
                        <h2 >Sign up hrr</h2>
                        <form method="POST" >
                            <div>
                                <label for="name"></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div >
                                <label for="pass"> </label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div >
                                <label for="email"> </label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div >
                                <label for="fname"></label>
                                <input type="text" name="fname" id="fname" placeholder="First Name"/>
                            </div>
                            <div >
                                <label for="lname"> </label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name"/>
                            </div>
                            <div>
                            <p>Please select enduser</p>
                            <?php
                            // displays all endusers in the database
                                $b="select username from end_user";
                                $res=mysqli_query($con,$b);
                                while($arr=mysqli_fetch_assoc($res)){
                                    echo ' <input type="radio" id="PT" name="euser" value='.$arr["username"].'>
                                    <label for='.$arr["username"].'>'.$arr["username"].'</label><br>';
                                }
                            ?>
                            </div>
                            
                            <div >
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>
        </section>


    </div>


</body>
</html>