<?php
    session_start();
?>
<html>
	<head>
		<title>
			Delete Members' Information
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
			$member_id = $_GET["member_id"];
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>"; 

			// Delete data from database
			$sql = "update member set is_active = '0', is_deleted = '1', update_time = now() where member_id = '{$member_id}'";
            if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/admin/admin.php?id={$id}'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/admin/admin.php?id={$id}'>Try again</a>";
            }
            // Close connection
            mysqli_close($mysql);
		?>
	</body>
	</center>
</html>