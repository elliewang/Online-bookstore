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
	<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
    <br>
	<br>    
	
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
			echo "Update Membership Information:";
			
			// Run a sql
			$result = $mysql->query("select * from member where member_id = '{$member_id}'");
			$result_arr = $result->fetch_row();  
		?>
		<form action="updateMember.php" method="POST">
		    <label>Name:</lable><input type="text" name="name" value="<?php echo $result_arr[1]?>"><br>
		    <label>Password:</label><input type="text" name="password" value="<?php echo $result_arr[9]?>"><br>			
		    <label>Street</label><input type="text" name="street" value="<?php echo $result_arr[4]?>"><br>
		    <label>City</label><input type="text" name="city" value="<?php echo $result_arr[5]?>"><br>
		    <label>State</label><input type="text" name="state" value="<?php echo $result_arr[6]?>"><br>
		    <label>Zipcode</label><input type="number" name="zipcode" value="<?php echo $result_arr[7]?>"><br>
		    <label>Country</label><input type="text" name="country" value="<?php echo $result_arr[10]?>"><br>
		    <label>Phone</label><input type="number" name="phone" value="<?php echo $result_arr[8]?>"><br>
		    <label>Email</label><input type="email" name="email" value="<?php echo $result_arr[11]?>"><br>
		    <input type="submit" value="submit">
	    </form>
	</center>
	</body>
</html>