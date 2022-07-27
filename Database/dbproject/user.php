<?php session_start();
// gets end user name + welcome message
echo"<h1 style='color:white'>Welcome MR. : ". $_SESSION['name']; echo "</h1>";
$username=$_SESSION['name'];
error_reporting(0);
if(!$username){
	echo "failed";
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body style="background: #332e2e ">
<?php



//THIS CLASS FOR END USER :)
        $nam=$_SESSION['name'];
        require_once("connection.php");
     $sa="SELECT description from job_posting where is_manOrIntern=0";
     $dx=mysqli_query($con,$sa);
    
     echo "<div class='main container'> <h2>job postings</h2>";
     echo"</div>";
     //List all job postings, internship postings separately.
     while( $h= mysqli_fetch_assoc($dx)){
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div> $va </div>";
         }
         echo "</div>";
     }}
     $sa="SELECT description from job_posting where is_manOrIntern=1";
     $dx=mysqli_query($con,$sa);
     $h= mysqli_fetch_assoc($dx);
     ////List all job postings, internship postings separately.
     echo "<div class='main container'> <h2>internship postings</h2>";
     echo"</div>";
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div> $va </div>";
         }
         echo "</div>";
     }
     
     $sa="SELECT Distinct description, numOpenings from job_posting where is_manOrIntern=0";
     $dx=mysqli_query($con,$sa);
     $h= mysqli_fetch_assoc($dx);
     echo "<div class='main container'> <h2>job postings and openings</h2>";
     echo"</div>";
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div>$key: $va </div>";
         }
         echo "</div>";
     }
     $sa="SELECT Distinct description, numOpenings from job_posting where is_manOrIntern=1";
     $dx=mysqli_query($con,$sa);
     $h= mysqli_fetch_assoc($dx);
     echo "<div class='main container'> <h2>internship postings and openings</h2>";
     echo"</div>";
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div>$key: $va </div>";
         }
         echo "</div>";
     }

     $sa="select Distinct jid, description,salary
     from job_posting
     where salary >= all (select salary from job_posting)";
     ////List all job postings, internship postings separately.
     echo "<div class=' container'> <h2>highest paying job</h2>";
     echo"</div>";
     $dx=mysqli_query($con,$sa);
     $h= mysqli_fetch_assoc($dx);
     
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div>$key: $va </div>";
         }
         echo "</div>";
     }
     $sa="
     select J.description, J.salary,C.name 
     from job_posting J, company C
     where J.contract_type='PT' and J.comp_cid=C.cid and C.address like '%bodrum%';";
     
     echo "<div class=' container'> <h2>best souitable job for a candidate in bodrum:</h2>";
     echo"</div>";
     $dx=mysqli_query($con,$sa);
     $h= mysqli_fetch_assoc($dx);
     
     foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div>$key: $va </div>";
         }
         echo "</div>";
     }

     $sfa="select * from (job_posting J natural join internshipJobPosting J1) join company C on J.comp_cid = C.cid where C.name = 'Google'  and J1.minnumdays>20;";
     
     echo "<div class=' container'> <h2>highest paying manager job:</h2>";
     echo"</div>";
     $dx=mysqli_query($con,$sfa);
     
     while($h= mysqli_fetch_assoc($dx)){
          foreach($dx as $data)
     {  echo "<div class='main container'>";
         foreach($data as $key =>$va){
             echo "<div>$key: $va </div>";
         }
         echo "</div>";
     }}
    ?>

</body>
</html>