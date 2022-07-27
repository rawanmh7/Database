<?php session_start();
// get company name + welcome message
echo"<h1 style='color:white'>welcome to company : ". $_SESSION['name']; echo "</h1>";
$username=$_SESSION['name'];
if(!$username){
	echo "failed";
};
error_reporting(E_ALL);
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
<body style="background:#332e2e">
<!-- php code here! -->
<?php
    require_once("connection.php");
    //Display the first name and last name of the HRRs that posted a job listing for the company 
    //(Part#2.Q5)
    $query="select distinct h.fname, h.lname
    from hrr h, job_posting j, company c
    where h.username = j.hrr_username and c.cid = j.comp_cid and c.name like '".$_SESSION['name']."';";
    //Display company’s job postings, along with the number of applicants
    $compid="select cid from company where name='".$_SESSION['name']."'";
    $id=mysqli_query($con, $compid);
    $cid=mysqli_fetch_assoc($id);
    $c_id=$cid['cid']; 
    //Display applications to each posting (Part#2.Q6) 
    $each="Select description,count(a.jid) count
    from application a
    join job_posting j on a.jid = j.jid
    where comp_cid = '".$c_id."'
    group by description";
    //Display unemployed end-users (Part#2.Q1, requires slight modification)
    $unemp="select E.username
    from end_user E
    where E.username not in (select distinct username from eu_employer);";
    //Display the one that has been working at the same company for the longest period
    $longesttime="select username
    from eu_employer as e
    where e.beginDate = (select min(beginDate) from eu_employer);
    ";
    //Display the one with maximum experience (Part#2.Q8, requires slight modification)
    $exp="select username
    from (select sum(endDate - beginDate) as exp, username
            from employment_history
            group by username) as e
    where e.exp >= all (select sum(endDate - beginDate) 
                        from employment_history 
                        group by username);";
    //Display the one with maximum experience (Part#2.Q8, requires slight modification)
    $intern="select *
    from (job_posting J natural join internshipJobPosting J1) join company C on J.comp_cid = C.cid;";
    $eachinter= "select j.* from internshipjobposting i join job_posting j on i.jid = j.jid    ";
    $eachexe=mysqli_query($con,$eachinter);
    
    $exe=mysqli_query($con,$query);
    $pg=mysqli_num_rows($exe);
    
    //...................................
    $internexe=mysqli_query($con,$intern);
    
    $expexe=mysqli_query($con,$exp);
    $exparr=mysqli_fetch_assoc($expexe);
    $long=mysqli_query($con,$longesttime);
    $longarr=mysqli_fetch_assoc($long);
    $unempq=mysqli_query($con,$unemp);
   
    $newexe=mysqli_query($con,$each);
    $newex=mysqli_query($con,$each);
    
?>

<!-- end of php/mysql code -->
<div class="mymain">
    <div class="container box">
    <h1>   list of HRR names</h1>
    <ul>
     <?php
     while ($arr=mysqli_fetch_assoc($exe)){
     echo "<h5>First name: ".$arr['fname']."  <br>Lirst name: ".$arr['lname']."</h5>";
     }
     ?>   
</ul>
    </div>
    <div class="container">
        <h1> Applications to each posting </h1>
        <?php
        while($newarr=mysqli_fetch_assoc($newexe)){
            echo "<h3>job name: ".$newarr['description']."<br> number of applicants: ".$newarr['count']."</h3>";
        }

          ?> 
</div>
<div class="container ">
        <h1> Names of unemployed End users </h1>
        <?php while($unemparr=mysqli_fetch_assoc($unempq)){
     echo "<h4>Name:  ".$unemparr['username']."</h4>"; }
     ?> 
</div>
<div class="container">
        <h1> Name of employeer working for the longest time </h1>
        <?php
     echo "<h3>Name: ".$longarr['username']."</h3>";
     ?> </div>
     <div class="container">
        <h1> Applications to each of job posting </h1>
        <?php
        while($newar=mysqli_fetch_assoc($newex)){
            echo "<h3>job name: ".$newar['description']."<br> applicants: ".$newar['count']."</h3>";

        }

          ?> 
</div>
     <div class="container">
        <h1> Experienced employee </h1>
        <?php
     echo "<h3> Name: ".$exparr['username']."</h3>";
     ?>
</div>
<div class="container">
        <h1> Internships </h1>
        <?php
        while($internarr=mysqli_fetch_assoc($internexe)){
     echo "<h3> Name: ".$internarr['description']."<br> Number of openings: ".$internarr['numOpenings'];
     }  ?>
   
</div>
<div class="container">
        <h1> Internships details:</h1>
        <?php
        while($eachintern=mysqli_fetch_assoc($eachexe)){
     echo "<h3> Name: ".$eachintern['description']."<br> Number of openings: ".$eachintern['numOpenings']."<br>HRR name: ".$eachintern['hrr_username']."<br> opening date : ".$eachintern['openingdate']."</h3>";
     }  ?>
   
</div>
</div>
</body>
</html>