<?php
    session_start();
?>
<html>
	<head>
		<title>
			Update Books' Information
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
			$book_id=$_GET['book_id']; 
		    $book_name = $_POST['book_name'];
			$book_isbn = $_POST['book_isbn'];
			$author_name = $_POST['author_name'];
			$publisher_name = $_POST['publisher_name'];
			$publish_date = $_POST['publish_date'];
			$book_desc = $_POST['book_desc'];		
		    $edition = $_POST['edition'];
			$original_price = $_POST['original_price'];
			$price = $_POST['price'];
			$quantity = $_POST['quantity'];	
			$is_deleted = $_POST['is_deleted'];		
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			
			// Run a sql	
			$sql = "UPDATE `book` SET `book_name`='{$book_name}', `book_isbn`='{$book_isbn}', `publish_date`='{$publish_date}', `book_desc`='{$book_desc}', `edition`='{$edition}',`original_price`='{$original_price}', `price`='{$price}', `quantity`='{$quantity}', `is_edited`='1', `is_deleted`='{$is_deleted}',  `update_time`=now() WHERE `book_id` = '{$book_id}'";
			$sq = "UPDATE `author` SET `author_name`='{$author_name}', `update_time`=now() WHERE `author_id` = ( SELECT `author_id` FROM `book_author` where`book_id` = '{$book_id}')";
			$sl = "UPDATE `publisher` SET `publisher_name`='{publisher_name}', `update_time`=now() WHERE `publisher_id` =(SELECT `publisher_id` FROM `book_publisher` WHERE `book_id` = '{$book_id}')";
			if ($mysql->query($sql) === TRUE AND $mysql->query($sq) === TRUE AND $mysql->query($sl) === TRUE ) {
               echo "Succesful! <a href='/book_sales/admin/admin.php'>Check the result</a>";
            } else {
               echo "Something Wrong! <a href='/book_sales/admin/admin.php'>Try again</a>";
            }            
		    // Close connection
		    mysqli_close($mysql);
		?>
	</center>
	</body>
</html>