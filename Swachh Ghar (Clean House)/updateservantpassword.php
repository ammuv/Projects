<?php
		session_start();
		if(isset($_SESSION['name'])){
		  $name=$_SESSION['name'];
		  $id=$_SESSION['id'];
		}
		else{
		  header("Location: errorpage.php");
		}

		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$reenterpass = $_POST['reenternewpass'];


		if($newpass != $reenterpass){
			echo "<script type='text/javascript'>alert('Please enter the same password for New password and Re-enter password!');</script>";
			echo "<script type='text/javascript'>setTimeout(\"location.href = 'changeservantpassword.php';\",1);</script>";
			exit;
		}



				$serverName = "myserver-2018.database.windows.net";
						$connectionOptions = array(
					    "Database" => "SwachhGhar",
					    "Uid" => "sampledb",
					    "PWD" => "Arunvishal13"
					);
					$conn = sqlsrv_connect($serverName, $connectionOptions);
					if( $conn === false ) {
					     die( print_r( sqlsrv_errors(), true));
					}

					$sql = "select Password from HouseMaid where MID=$id";
					$getResults= sqlsrv_query($conn, $sql);

					if ($getResults == FALSE)
					    echo (sqlsrv_errors());
					 
					while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
						if($oldpass!=$row['Password']){
							echo "<script type='text/javascript'>alert('Invalid Old Password!');</script>";
							echo "<script type='text/javascript'>setTimeout(\"location.href = 'changeservantpassword.php';\",1);</script>";
							exit;
						}
					}
					

					$tsql= "update HouseMaid set Password = '$newpass' where MID=$id";
					sqlsrv_query($conn, $tsql);
					echo "<script type='text/javascript'>alert('Password changed successfully!');</script>";
					echo "<script type='text/javascript'>setTimeout(\"location.href = 'viewservantprofile.php';\",1);</script>";
							
	?>



