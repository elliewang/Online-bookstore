<?php
    session_start();
?>
<html>
	<head>
		<title>
			Delete orders' Information
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
			$order_id=$_GET['order_id'];
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>"; 

			// Delete data from database
			$sql = "UPDATE `order` SET `status` = '0', `update_time` = now() where `order_id` = '{$order_id}'";
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