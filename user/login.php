<?php
    session_start();
?>
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
<?php		
	// Get data      
	$member_id  = $_POST['member_id'];
	$password = $_POST['password'];
	
	// Create connection
	$conn = new mysqli("localhost", "root", "mysql", "book_sales");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}  
	// ID and name couldn't be Null
	if ($member_id == "" || $password == "")
	{
		die("Please input id and password! <a href='/book_sales/user/login.html'>Try again</a>");
	}		
	// select data from table 
	$sql = "SELECT * FROM `member` where `member_id`='{$member_id}' and `password`='{$password}'";
    $resultSet = $conn->query($sql);
	$result_arr = $resultSet->fetch_row(); 
	//member exists
	if(mysqli_num_rows($resultSet)>0){
	    //member is deleted or not
		if($result_arr[12]=="1")
		{
		    $_SESSION['member_id'] = $_POST['member_id'];
			header('Location: user.php');
		}else{
		    //member is deleted
			echo "Your account is deleted, please <a href='/book_sales/user/login.html'>sign up a new account</a>";
		}
	}else{
		//member not exit
		echo "id or password is Wrong! <a href='/book_sales/user/login.html'>Try again</a>";
	}	           
?>
</center>