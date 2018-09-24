<center>
<br>
<?php
    session_start();
	if(!isset($_SESSION['id'])){
		if(!isset($_SESSION['member_id'])){
			echo "<table border=0 width='950'>";
			echo "<tr><td><a href = '/book_sales/user/register.html'>Sign Up</a></td><td><a href = '/book_sales/user/login.html'>User Login in</a></td><td><a href = '/book_sales/admin/login.html'>Administrator Login in</a></td><tr>";
			echo "</table>";
		}else{
			$member_id=$_SESSION['member_id'];
			echo "<table border=0 width='200'>";
			echo "<tr><td>User $member_id, </td><td><a href='/book_sales/user/user.php'>Account</a></td><td><a href='/book_sales/exit.php'>Sign out</a></td><tr>";
			echo "</table>";
		}
	}else{
		$id=$_SESSION['id'];
		echo "<table border=0 width='250'>";
		echo "<tr><td>Administrator $id</td><td><a href='/book_sales/admin/admin.php'>Account</a></td><td><a href='/book_sales/exit.php'>Sign out</a></td><tr>";
		echo "</table>";
	}
?>
<br>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
<br>
    <?php		
		// Get data      
		$member_id = $_SESSION['member_id'];
		// Create connection
		$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
		// Check connection
		if ($mysql->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}  
		echo "<a href = '/book_sales/index.php'>back</a>". "</br>". "</br>";
		//Book Cover Page Information
		$sl = $mysql->query("SELECT *, SUM(od.`item_quantity`) as sold_quantity FROM `book` b JOIN `order_detail` od ON b.book_id=od.book_id WHERE `order_id` IN (SELECT `order_id` FROM `order` WHERE YEAR(`order_time`) =YEAR(now())) GROUP BY od.`book_id` ORDER BY SUM(od.`item_quantity`) DESC");
		echo "Best seller of this year". "<br>". "<br>";
		echo "<table border=1 width='950'>";
		echo "<tr><td>Cover Page</td><td>Book Name</td><td>ISBN</td><td>Edition</td><td>Price</td><td>Storage</td><td>Book Desc</td><td>Sold Quantity</td><td>Book Detail</td>";
       	for($i=0;$i<mysqli_num_rows($sl);$i++){
            $sl_arr = mysqli_fetch_array($sl);
			$book_id = $sl_arr['book_id'];
            $book_name = $sl_arr['book_name'];			
            $book_isbn = $sl_arr['book_isbn'];	
			$edition = $sl_arr['edition'];	
			$price = $sl_arr['price'];
            $quantity = $sl_arr['quantity'];
			$book_desc = $sl_arr['book_desc'];
			$sold_quantity = $sl_arr['sold_quantity'];
			$_SESSION['book_id'] = $sl_arr["book_id"];
					
            // fill in table
			echo '<tr><td><img width="150" height="200" src="data:image;base64,'.$sl_arr[9].'"></td>';
			echo "<td>$book_name</td><td>$book_isbn</td><td>$edition</td><td>$price</td><td>$quantity</td><td>$book_desc</td><td>$sold_quantity</td><td><a href = '/book_sales/book.php?book_id={$book_id}'>Book Detail</td>";			
            }
		echo "</table>". "</br>". "</br>";
    ?>
</center>