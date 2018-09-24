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
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
	<br>
		<?php
		    // Get data
			$member_id = $_SESSION['member_id'];
			$cart_id = $_GET['cart_id'];
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>"; 

			// Delete data from database
			
			$sql = $mysql->query("DELETE FROM `cart` where `cart_id` = '{$cart_id}'");
			$sq = $mysql->query("DELETE FROM `cart_detail` where `cart_id` = '{$cart_id}'");
            if ($sq) {
               echo "Succesful! <a href='/book_sales/user/user.php'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/user/user.php'>Try again</a>";
            }
            // Close connection
            mysqli_close($mysql);
		?>
	</body>
</html>