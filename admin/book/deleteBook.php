<?php
    session_start();
?>
<html>
	<head>
		<title>
			Delete Books' Information
		</title>
	</head>
	<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
    <br>
    <br>
		<?php
		    // Get data
		    $id=$_SESSION['id']; 
			$book_id=$_GET['book_id']; 
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>"; 

			// Delete data from database
			$sql = "UPDATE `book` SET `is_deleted` = '1', `update_time` = now() where `book_id` = '{$book_id}'";
            if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/admin/admin.php'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/admin/admin.php'>Try again</a>";
            }
            // Close connection
            mysqli_close($mysql);
		?>
	</center>
	</body>
</html>