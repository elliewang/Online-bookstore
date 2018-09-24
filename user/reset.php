<?php
    session_start();
?>
<html>
	<head>
		<title>
			Reset password
		</title>
	</head>
	<body>
	<?php
		// Get data
		$member_id = $_SESSION['member_id'];	
	?>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
	<br>
	<br>	
	    Reset password: 
		<form name="resetpswd" action="/book_sales/user/resetpswd.php" method="POST">
		   <table>
		       <tr>
			       <td>New password:</td>
				   <td><input type="text" name="pswd"></td><tr>
				   </br>
			       <td><input type="submit" name="submit" value="submit"></td><tr>
			   </tr>
			</table>
		</form>
	</body>
	<center>
</html>