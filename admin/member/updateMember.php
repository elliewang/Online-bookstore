<?php
    session_start();
?>
<html>
	<head>
		<title>
			Update Members' Information
		</title>
	</head>
	<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
    <br>
    <br>
		<?php
			//Get data 
			$id=$_SESSION['id'];
			$member_id = $_GET['member_id'];
			$name = $_POST['name'];
			$password = $_POST['password'];
			$street = $_POST['street'];					
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zipcode = $_POST['zipcode'];		
			$country = $_POST['country'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$is_active = $_POST['is_active'];
			$is_deleted = $_POST['is_deleted'];					
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			
			// Run a sql	
			$sql = "update member set member_name='{$name}', password='{$password}', street='{$street}', city='{$city}', state='{$state}', zipcode='{$zipcode}', country='{$country}', phone_number='{$phone}', email='{$email}', is_active='{$is_active}', is_deleted='{$is_deleted}', update_time = now() where member_id = '{$member_id}'";
			if ($mysql->query($sql) === TRUE) {
               echo "Succesful! <a href='/book_sales/admin/admin.php?id={$id}'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/admin/admin.php?id={$id}'>Try again</a>";
            }            
		    // Close connection
		    mysqli_close($mysql);
	?>
	</center>
	</body>
</html>