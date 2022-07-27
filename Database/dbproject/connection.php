
	<?php
        // connect to MySQL 
	$server="localhost";
	$username="root";
	$password="Rawansoft5686";
	$db="jobfindingapp";
	
	$con=mysqli_connect($server,$username,$password,$db);
	if(!$con)
	{
		die("connection failed".mysqli_connect_error());
	}

	 
	function con_close()
	{
		global $con;
		mysqli_close($con);
	}
	
	
	?>
