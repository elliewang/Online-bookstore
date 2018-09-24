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
			Delete Members' Information
		</title>
	</head>
	<body>
		<?php
		    // Get data
		    $member_id = $_SESSION['member_id'];

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
               echo "Succesful! <a href='/book_sales/user/user.php'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/user/user.php'>Try again</a>";
            }
            // Close connection
            mysqli_close($mysql);
		?>
	</body>
</html>