<?php
    session_start();
?>
<html>
	<head>
		<title>
			Reset password
		</title>
	</head>
	<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
	<br>
	<br>
		<?php
		    //Get data 
		    $member_id = $_SESSION['member_id'];
		    $pswd = $_POST["pswd"];					
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			
			// Run a sql	
			$sql = "UPDATE `member` SET `password`='{$pswd}', `update_time` = now() where `member_id` = '{$member_id}'";
			if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/user/user.php'>Login in</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/user/login.html'>Try again</a>";
            }            
		    // Close connection
		    mysqli_close($mysql);
		?>
	</center>
	</body>
</html>