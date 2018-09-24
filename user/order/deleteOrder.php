<?php
    session_start();
	if(!isset($_SESSION['member_id'])){
		echo "<table border=0 width='850'>";
		echo "<tr><td><a href = '/book_sales/user/login.html'>User Login in</a></td><td><a href = '/book_sales/admin/login.html'>Administrator Login in</a></td>";
		echo "</table>";
	}else{
		$member_id=$_SESSION['member_id'];
		echo "<td>User $member_id, <a href='/book_sales/exit.php'>Sign out</a></td>". "</br>";
	}
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
		<?php
		    // Get data
			$member_id = $_SESSION['member_id'];
		    $order_id = $_GET['order_id'];
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";

			// Delete data from database
			$sql = "update `order` set `status` = '0', update_time = now() where `order_id` = '{$order_id}'";
            if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/user/user.php'>Check the result</a>";
            }else {
               echo "Something Wrong! <a href='/book_sales/user/user.php'>Try again</a>";
            }
            // Close connection
            mysqli_close($mysql);
		?>
	</center>
	</body>
</html>