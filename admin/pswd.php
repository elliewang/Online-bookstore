<html>
	<head>
		<title>
			Administrator New Password
		</title>
	</head>
	<body>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
		<?php
		    //Get data 
		    $id = $_GET['id'];
			$password = $_POST["password"];						
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			
			// Run a sql	
			$sql = "update `admin` set `password`='{$password}', `update_time` = now() where `admin_id` = '{$id}'";
			if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/admin/login.html'>Sign in again</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/admin/alterPswd.php?id={$id}'>Try again</a>";
            }            
		    // Close connection
		    mysqli_close($mysql);
		?>
	</body>
</html>