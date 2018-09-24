<?php
    session_start();
?>
<html>
	<head>
		<title>Edit Books' Information</title>
	</head>
	<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
    <br>
    <br>
		<?php
		    // Get data
		    $id=$_SESSION['id'];  
			$book_id=$_GET['book_id'];  
			// Create connection
			$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
			// Check connection
			if ($mysql->connect_error) {
			    die("Connection failed: " . $mysql->connect_error);
			} 
			echo "<p><font color=\"red\">Connected successfully</font></p>";  
			echo "Update Book Information:";
			
			// Run a sql
			$result = $mysql->query("select * from book where book_id = '{$book_id}'");
			$result_arr = $result->fetch_row(); 
			
			$re = $mysql->query("select * from author u JOIN book_author b ON u.author_id = b.author_id where b.book_id = '{$book_id}'");
			$re_arr = $re->fetch_row(); 
			
			$sql = $mysql->query("select * from publisher p JOIN book_publisher b ON p.publisher_id = b.publisher_id where b.book_id = '{$book_id}'");
			$sql_arr = $sql->fetch_row(); 
		?>

		<form action="updateBook.php?book_id=<?php echo $book_id;?>" method="POST">
		    <label>Book Name: </lable><input type="text" name="book_name" value="<?php echo $result_arr[2]?>"><br>
		    <label>ISBN: </label><input type="number" name="book_isbn" value="<?php echo $result_arr[1]?>"><br>		
			<label>Author: </label><input type="text" name="author_name" value="<?php echo $re_arr[1]?>"><br>	
			<label>Publisher: </label><input type="text" name="publisher_name" value="<?php echo $sql_arr[1]?>"><br>		
		    <label>Publish Date: </label><input type="date" name="publish_date" value="<?php echo $result_arr[4]?>"><br>
		    <label>Book Desc: </label><input type="text" name="book_desc" value="<?php echo $result_arr[3]?>"><br>
		    <label>Edition: </label><input type="text" name="edition" value="<?php echo $result_arr[5]?>"><br>
			<label>Original Price: </label><input type="text" name="original_price" value="<?php echo $result_arr[6]?>"><br>
		    <label>Price: </label><input type="text" name="price" value="<?php echo $result_arr[7]?>"><br>
		    <label>Quantity: </label><input type="number" name="quantity" value="<?php echo $result_arr[8]?>"><br>	
			<label>Is deleted: </label><input type="number" name="is_deleted" value="<?php echo $result_arr[11]?>"><br>	
			<input type="submit" value="submit">
		</form>
	</center>
	</body>
</html>