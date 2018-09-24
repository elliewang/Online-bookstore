<center>
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
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
<?php		
		// Get data      
		$member_id = $_SESSION['member_id'];
		$order_id = $_GET['order_id'];
		// Create connection
		$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
		// Check connection
		if ($mysql->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}  
		$sql = $mysql->query("SELECT * FROM `order_detail` where `order_id` ='{$order_id}'");
		echo "<table border=1 width='950'>";
		echo "Order Information:". "<br>";
		echo "<a href='/book_sales/user/user.php'>Back</a>". "</br>";
		echo "<tr><td>Order Id</td><td>Book Id</td><td>Book Name</td><td>ISBN</td><td>Book Desc</td><td>Author</td><td>Publisher</td><td>Publish Date</td><td>Edition</td><td>Price</td><td>Image</td><td>Item Quantity</td></tr>";
        for($i=0;$i<mysqli_num_rows($sql);$i++){
            $sql_arr = mysqli_fetch_assoc($sql);
            $book_id = $sql_arr['book_id'];	
            $item_quantity = $sql_arr['item_quantity'];
			$sq = $mysql->query("SELECT * FROM `book` where `book_id` ='{$book_id}'");
			$sq_arr = mysqli_fetch_array($sq);
			$book_name = $sq_arr['book_name'];	
			$book_isbn = $sq_arr['book_isbn'];	
			$book_desc = $sq_arr['book_desc'];	
			$publish_date = $sq_arr['publish_date'];	
			$edition = $sq_arr['edition'];	
			$price = $sq_arr['price'];		
			$lynn = $mysql->query("select * from author u JOIN book_author b ON u.author_id = b.author_id where b.book_id = '{$book_id}'");
			$lynn_arr = mysqli_fetch_array($lynn);
			$author_name = $lynn_arr['author_name'];
				
			$lily = $mysql->query("select * from publisher p JOIN book_publisher b ON p.publisher_id = b.publisher_id where b.book_id = '{$book_id}'");
			$lily_arr = mysqli_fetch_array($lily);
			$publisher_name = $lily_arr['publisher_name'];
			
            // fill in table
            echo "<tr><td>$order_id</td><td>$book_id</td><td>$book_name</td><td>$book_isbn</td><td>$book_desc</td><td>$author_name</td><td>$publisher_name</td><td>$publish_date</td><td>$edition</td><td>$price</td>";
			echo '<td><img width="150" height="200" src="data:image;base64,'.$sq_arr[9].'"></td>';
			echo "<td>$item_quantity</td></tr>";
        }
		echo "</table>";
?>
</center>