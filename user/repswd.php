<?php
    session_start();
?>
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
<?php
    $member_id = $_SESSION['member_id'];
	$answer = $_POST['answer'];
	// Create connection
	$conn = new mysqli("localhost", "root", "mysql", "book_sales");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "<p><font color=\"red\">Connected successfully</font></p>";  
    $sql = "SELECT * FROM member WHERE member_id = '{$member_id}' AND answer = '{$answer}'";
    $resultSet = $conn->query($sql);
	if(mysqli_num_rows($resultSet)>0){
		echo "<a href='/book_sales/user/reset.php'>Reset you password</a>"; 
	}else{
		echo "You answer is Wrong! <a href='/book_sales/user/pswd.html'>Try again</a>";
	}	
?>
</center>