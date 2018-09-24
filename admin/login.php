<?php
    session_start();
?>
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
		<?php		
			// Get data      
			$id  = $_POST['id'];
			$password = $_POST['password'];
			//session_start();
			// Create connection
			$conn = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}  

			// ID and name couldn't be Null
			if ($id == "" || $password == "")
			{
				die("Please input id and password! <a href='/book_sales/admin/login.html'>Try again</a>");
			}			
			// select data from table 
			$sql = "SELECT `admin_id`, `password` FROM `admin` where `admin_id` = '{$id}' and `password` = '{$password}'";
            $resultSet = $conn->query($sql);
			if(mysqli_num_rows($resultSet)>0){
			    $_SESSION['id'] = $_POST['id'];
				header('Location: admin.php');
			}else{
			    echo "id or password is Wrong! <a href='/book_sales/admin/login.html'>Try again</a>";
			}           
		?>
</center>