<?php
    session_start();
?>
<html>
	<head>
		<title>
			Register 
		</title>
	</head>
	<body>		
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
	<br>
	<br>
		<?php		
		    if(isset($_SESSION['id'])!="")
		    {
			     header("Location: user.php");
		    } 
			// Get data   
			$name = $_POST["name"];
			$password = $_POST["password"];
			$question = $_POST["question"];
			$answer = $_POST["answer"];
			$street = $_POST["street"];
			$city = $_POST["city"];
			$state = $_POST["state"];
			$zipcode = $_POST["zipcode"];
			$country = $_POST["country"];
			$phone_number = $_POST["phone_number"];
			$email  = $_POST["email"];
			// Create connection
			$conn = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			// Insert data into table 
			$sq = "SELECT * FROM `member` where `member_name` ='$name'";
			$resultSet = $conn->query($sq);
			if(mysqli_num_rows($resultSet)>0){
			    echo "There is an existing member the same name as you, <a href='/book_sales/user/register.html'>try again</a>";
			}else{
			    $sql = "INSERT INTO `member`(`member_name`, `password`,`question`, `answer`, `street`, `city`, `state`, `zipcode`, `phone_number`, `country`, `email`, `is_active`, `is_deleted`, `create_time`, `update_time`) VALUES ('$name', '$password', '$question', '$answer', '$street', '$city', '$state',  '$zipcode', '$phone_number',  '$country', '$email', '1', '0', now(), now())";
                if ($conn->query($sql) === TRUE){
			        $result = $conn->query("SELECT * FROM `member` WHERE `member_name` = '{$name}'");
			    	$result_arr = mysqli_fetch_assoc($result);
                    echo "Please <a href='/book_sales/user/login.html'>Login in</a>, ";
			    	echo "You id is". $result_arr['member_id'];
			    } else {
		    	    echo "Something Wrong! <a href='/book_sales/user/register.html'>Try again</a>";
		        }
		        // Close connection
		        mysqli_close($conn);
			}
		?>
	</center>
	</body>
</html>