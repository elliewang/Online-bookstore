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
	$cart_id = $_GET['cart_id']; 
	$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
	// Check connection
	if ($mysql->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}  
	//Book Cover Page Information
	$sl = $mysql->query("select * from cart_detail where `cart_id` ='{$cart_id}'");
	echo "<a href = '/book_sales/user/user.php'>Back</a>". "<br>". "<br>";	
    for($i=0;$i<mysqli_num_rows($sl);$i++){
        $sl_arr = mysqli_fetch_array($sl);	
		$book_id = $sl_arr['book_id'];
        $item_quantity = $sl_arr['item_quantity'];	
		
		$sql = $mysql->query("select * from book where `book_id` ='{$book_id}'");
		$sql_arr = mysqli_fetch_array($sql);
		$book_name = $sql_arr['book_name'];
		$book_isbn = $sql_arr['book_isbn'];
		$category = $sql_arr['category'];
		$edition = $sql_arr['edition'];
		$price = $sql_arr['price'];
		echo "<table border=1>";
		echo '<tr><td><img width="300" height="400" src="data:image;base64,'.$sql_arr[9].'"></td>';
		echo "</table>". "</br>". "</br>";
		echo "<table border=1 width='935'>";
    	echo "<tr><td>Cart ID</td><td>Book ID</td><td>Book Name</td><td>ISBN</td><td>Category</td><td>Edition</td><td>Price</td><td>Item Quantity</td>";
		echo "<tr><td>$cart_id</td><td>$book_id</td><td>$book_name</td><td>$book_isbn</td><td>$category</td><td>$edition</td><td>$price</td><td>$item_quantity</td>";
	}
?>
</center>
		