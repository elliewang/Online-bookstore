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
		$publisher_id = $_GET['publisher_id'];
		// Create connection
		$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
		// Check connection
		if ($mysql->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}  
		//Book Cover Page Information
		$sl = $mysql->query("select * from book b JOIN book_publisher bp ON b.book_id=bp.book_id where `publisher_id` ='{$publisher_id}'");		
		echo "<a href = '/book_sales/search.php'>Back</a>". "<br>". "<br>";
		echo "<table border=1 width='950'>";
		echo "<tr><td>Cover Page</td><td>Book Name</td><td>ISBN</td><td>Author</td><td>Publisher</td><td>Edition</td><td>Price</td><td>Quantity</td><td>Book Desc</td><td>Book Detail</td>";
       	for($i=0;$i<mysqli_num_rows($sl);$i++){
            $sl_arr = mysqli_fetch_array($sl);
			$book_id = $sl_arr['book_id'];
            $book_name = $sl_arr['book_name'];			
            $book_isbn = $sl_arr['book_isbn'];	
			$edition = $sl_arr['edition'];	
			$price = $sl_arr['price'];
            $quantity = $sl_arr['quantity'];
			$book_desc = $sl_arr['book_desc'];
			
			$lynn = $mysql->query("select * from author u JOIN book_author b ON u.author_id = b.author_id where b.book_id = '{$book_id}'");
			$lynn_arr = mysqli_fetch_array($lynn);
			$author_name = $lynn_arr['author_name'];

			$lily = $mysql->query("select * from publisher p JOIN book_publisher b ON p.publisher_id = b.publisher_id where b.book_id = '{$book_id}'");
			$lily_arr = mysqli_fetch_array($lily);
			$publisher_name = $lily_arr['publisher_name'];
					
            // fill in table
			echo '<tr><td><img width="150" height="200" src="data:image;base64,'.$sl_arr[9].'"></td>';
			echo "<td>$book_name</td><td>$book_isbn</td><td>$author_name</td><td>$publisher_name</td><td>$edition</td><td>$price</td><td>$quantity</td><td>$book_desc</td><td><a href = '/book_sales/book.php?book_id={$book_id}'>Book Detail</td>";			
            }
		echo "</table>". "</br>". "</br>";
    ?>
</center>