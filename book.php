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
		$member_id=$_SESSION['member_id'];   
		$book_id = $_GET['book_id'];
		// Create connection
		$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
		// Check connection
		if ($mysql->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}  
		//Book Cover Page Information
		$sl = $mysql->query("select * from book where `book_id` ='{$book_id}'");
		echo "<table border=1>";
       	for($i=0;$i<mysqli_num_rows($sl);$i++){
            $sl_arr = mysqli_fetch_array($sl);		
            // fill in table
			echo '<tr><td><img width="300" height="400" src="data:image;base64,'.$sl_arr[9].'"></td>';
            }
		echo "</table>". "</br>". "</br>";
    ?>
    <?php		
		$sql = $mysql->query("select * from book where `book_id` ='{$book_id}'");
		echo "<table border=0 width='960'>";
		echo "<tr><td>Book ID</td><td>Book Name</td><td>ISBN</td><td>Category</td><td>Author</td><td>Publisher</td><td>Publish Date</td><td>Edition</td><td>Price</td><td>Storage</td>";
         	for($i=0;$i<mysqli_num_rows($sql);$i++){
            $sl_arr = mysqli_fetch_array($sql);
			$book_id = $sl_arr['book_id'];
            $book_name = $sl_arr['book_name'];			
            $book_isbn = $sl_arr['book_isbn'];	
			$publish_date = $sl_arr['publish_date'];
			$edition = $sl_arr['edition'];	
			$price = $sl_arr['price'];
            $quantity = $sl_arr['quantity'];	
			$category = $sl_arr['category'];		
				
			$lynn = $mysql->query("select * from author u JOIN book_author b ON u.author_id = b.author_id where b.book_id = '{$book_id}'");
			if(mysqli_num_rows($lynn)>1){
			    $lynn_arr = mysqli_fetch_array($lynn);
			    $book_id = $lynn_arr['book_id'];
				$lyn = $mysql->query("SELECT ba1.author_id as author1, ba2.author_id as author2 FROM book_author ba1 JOIN book_author ba2 ON ba1.book_id = ba2.book_id WHERE ba1.author_id <> ba2.author_id AND ba1.book_id = '{$book_id}'");
				//for($i=0;$i<mysqli_num_rows($ql);$i++){
				$lyn_arr = mysqli_fetch_array($lyn);
				$author1 = $lyn_arr['author1'];
				$author2 = $lyn_arr['author2'];
				$ly = $mysql->query("SELECT CONCAT(a1.author_name, '&', a2.author_name) AS author_name FROM author a1 JOIN author a2 WHERE a1.author_id = '{$author1}' AND a2.author_id = '{$author2}'");
				$ly_arr = mysqli_fetch_array($ly);
				$author_name = $ly_arr[author_name];
				//}
			}else{
			    $lynn_arr = mysqli_fetch_array($lynn);
			    $author_name = $lynn_arr['author_name'];
			}

			$lily = $mysql->query("select * from publisher p JOIN book_publisher b ON p.publisher_id = b.publisher_id where b.book_id = '{$book_id}'");
			$lily_arr = mysqli_fetch_array($lily);
			$publisher_name = $lily_arr['publisher_name'];
				
            // fill in table
            echo "<tr><td>$book_id</td><td>$book_name</td><td>$book_isbn</td><td>$category</td><td>$author_name</td><td>$publisher_name</td><td>$publish_date</td><td>$edition</td><td>$price</td><td>$quantity</td>";			
            }
			echo "</table>". "</br>". "</br>";
    ?>
	<?php		
		$sq = $mysql->query("select * from book where `book_id` ='{$book_id}'");
		echo "<table border=0 width='960'>";
		echo "<tr><td>Book Desc</td></tr>". "</br>";
         	for($i=0;$i<mysqli_num_rows($sq);$i++){
            $sl_arr = mysqli_fetch_array($sq);
			$book_desc = $sl_arr['book_desc'];
				
            // fill in table
            echo "<tr><td>$book_desc</td></tr>";			
            }
			echo "</table>". "</br>". "</br>". "</br>";
    ?>
	
	<form name="addCart" action="/book_sales/user/cart/addCart.php?book_id=<?php echo $book_id;?>" method="POST">
	<table>
	<tr><td>Quantity:</td><td><input type="text" name="number" value="1"></td><tr>
	</br>
	<td><input type="submit" name="submit" value="Add to cart"></td><tr><tr>
	</form>
	</table>
	<br>
	<br>
</center>