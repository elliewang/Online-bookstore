<?php
    session_start();
?>
<html>
	<head>
		<title>Edit Administrator's Password</title>
	</head>
	<body>
	  <center>
	  <embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
		<?php
		    // Get data
		    $id=$_SESSION['id'];  
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			echo "Edit Administrator's Password:";
			
			// Run a sql
			$result = $mysql->query("select * from admin where admin_id = '{$id}'");
			$result_arr = $result->fetch_row();  
		?>

		<form action="pswd.php" method="POST">
			<td>New Password:<input type="text" name="password"></td>
			<td><input type="submit" value="submit"></td>
	    </form>
	  </center>
	</body>
</html>