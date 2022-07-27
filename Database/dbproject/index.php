<?php  session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME PAGE / WELCOME</title>

 
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- php/mysql code here -->
    <?php
        require_once("connection.php");
        if(isset($_POST['signin']))
     {
         $username = $_POST['username'];     
         $password = $_POST['pwd']; 
         
         $query = "SELECT * FROM hrr WHERE username = '$username' && passwrd = '$password'";
         $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    $abc = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $abc['username'];
    if ($rows) {
        header("location:hrr.php");
    } else {
        $query = "SELECT * FROM company WHERE name = '$username' && phone = '$password'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        $abc = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $abc['name'];
        if ($rows) {

            header("location:company.php");
        } else {
            $query = "SELECT * FROM end_user WHERE username = '$username' && passwrd = '$password'";
            $result = mysqli_query($con, $query);
            $rows = mysqli_num_rows($result);
            $abc = mysqli_fetch_assoc($result);
            $_SESSION['name'] = $abc['username'];
            if ($rows) {

                header("location:user.php");
            }
        }
    }
    echo "no account found please signup first";
}
?>
    <!-- php/mysql code end here -->
    <div >
	 <!-- Sign in  Form -->
        <section >
            <div class="container">
                <div >
                    <div >
                        
                        <a href="admin/register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div >
                        <h2 >Sign up</h2>
                        <form method="POST" >
                            <div >
                                <label for="your_name"><i ></i></label>
                                <input type="text" name="username" id="username" placeholder="Your Name"/>
                            </div>
                            <div >
                                <label for="your_pass"><i ></i></label>
                                <input type="password" name="pwd" id="pwd" placeholder="Password"/>
                            </div>
                            <div >
                                <input type="submit" name="signin" id="signin" value="Log in"/>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </section>

    </div>


</body>
</html>