<?php
    session_start();
?>
<html>
	<head>
		<title>Retrieve password</title>
	</head>
	<body>
		<?php
		    // Get data
		    $member_id = $_POST["id"];	  
			$_SESSION['member_id'] = $member_id;
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			
			// Run a sql
			$result = $mysql->query("select * from `member` where member_id = '{$member_id}'");
			$result_arr = $result->fetch_row(); 
		?>
        <center>
		<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
		<br>
		<br>
		Retrieve password:<br>
		<form action="repswd.php" method="POST">
		    <label>Question: </lable><input type="text" name="question" value="<?php echo $result_arr[2]?>"><br>
		    <label>Answer: </label><input type="text" name="answer"><br>	
		    <input type="submit" value="submit">
	    </form>
		</center>
	</body>
</html>