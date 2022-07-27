<?php session_start();
// gets hrr name + welcome message
echo"<h1 style='color:white'>welcome HRR MR. / MRS.  :". $_SESSION['name']; echo "</h1>";
error_reporting(0);
if(!$_SESSION['name']){
	header("location: index.php");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRR page</title>
    <!--  css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background:#332e2e">
<!-- php/mysql code here -->
<?php
error_reporting(0);
     $nam=$_SESSION['name'];
     require_once("connection.php");
     $sa="SELECT `jid` FROM job_posting ORDER BY jid DESC LIMIT 1";
     $dx=mysqli_query($con,$sa);
     $h=mysqli_fetch_assoc($dx);
     $id=$h['jid'];
     $newid=$id+1;
    
    if(isset($_POST['submit']))
		{
            
	    $description =  $_POST['desc'];
            $sal =  $_POST['sal'];
            $phone =  $_POST['phone'];
            $no =  $_POST['no'];
            $od =  $_POST['od'];
            $td =  $_POST['td'];
            $cpid =  $_POST['cpid'];
            $ismanor =  $_POST['ismanor'];
            $contract=  $_POST['contract'];   
            $formatedDate=date('Y-m-d', strtotime($od));
            echo $formatedDate;
                       // For each internship posting, display the applications, and their details
			$b="INSERT into job_posting(jid, description, salary, phone, numOpenings, hrr_username, openingdate, duration, comp_cid, is_manOrIntern, contract_type) VALUES('$newid','$description','$sal','$phone','$no','$nam','$formatedDate','$td','$cpid','$ismanor','$contract')";
			$result = mysqli_query($con,$b);
       if($result)
			{
				echo "data inserted sucessfully!";
            }else echo "<div style='color:white'>failed tarriable</div>";
        }

        $his='select * from job_posting where hrr_username="'.$_SESSION['name'].'"; ';
        $hisexe=mysqli_query($con,$his);
        $rows=mysqli_num_rows($hisexe);
?>


<!-- end of php/mysql code -->
    <div class="main">
        <div class="container">
            <h2>About HRR</h2>
            <div>Name: <?php echo $nam ?> </div>
            <div> Postins by manager:  <?php  
        
            while($hisarr= mysqli_fetch_assoc($hisexe)){
                //Display his/her postings
                echo "<pre>";
                echo "jid:  ".$hisarr['jid']."<br>description:  " .$hisarr['description']. "<br>opening date :  ".$hisarr['openingdate']."<br>number of openings :  " .$hisarr['numOpenings'];
                echo "</pre>";
            
    }
            ?>  </div>
    </div>
<br>
        <!-- Add job postings form -->
        <section >
            <div class="container">
                <div >
                    <div >
                        <h2 >Add new job Postings</h2>
                        <form method="POST" >
                            <div>
                                <label for="descereption"><i ></i></label>
                                <input type="text" name="desc" id="desc" placeholder="Descereption"/>
                            </div>
                            <div >
                                <label for="salary"><i></i></label>
                                <input type="number" name="sal" id="sal" placeholder="salary" step=".01"/>
                            </div>
                            <div >
                                <label for="phone"><i ></i></label>
                                <input type="number" name="phone" id="phone" placeholder="Phone" step=".0"/>
                            </div>
                            <div >
                                <label for="noOfOpening"><i ></i></label>
                                <input type="number" name="no" id="no" placeholder="number of jobs"/>
                            </div>
                            <div >
                                <label for="euser"><i ></i></label>
                                <input type="date" name="od" id="od" placeholder="opening date"/>
                            </div>
                            <div >
                                <label for="euser"><i></i></label>
                                <input type="number" name="td" id="td" placeholder="duration"/>
                            </div>
                            <div >
                                <label for="euser"><i ></i></label>
                                <input type="number" name="cpid" id="cpid" placeholder="company id"/>
                            </div>
                            <div >
                                <label for="euser"><i></i></label>
                                <input type="number" name="ismanor" id="ismanor" placeholder="Intern or man" min="0" max="1"/>
                            </div>
                            <div>
                            <div class="container" >
                                <p>Please select contract type</p>
                                <input type="radio" id="PartTime" name="contract" value="PT">
                                <label for="PartTime">PartTime</label><br>
                                <input type="radio" id="contract" name="contract" value="FT">
                                <label for="FullTime" namr="Fulltime">FullTime</label><br>
                            </div>
                          </div>
                            <div>
                                <input type="submit" name="submit" id="submit"  value="Register"/>
                            </div>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </section>


    </div>


</body>
</html>