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
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<?php		
	// Get data     
	$member_id = $_SESSION['member_id'];
	$cart_id = $_GET['cart_id']; 
	if($member_id == ""){
	    echo "Please <a href = '/book_sales/user/login.html'>sign in</a>";
	}else{
	    echo "Cart Information". "<br>";
	    echo "<table border=0 width='100'>";
	    echo "<tr><td>$member_id, <a href = '/book_sales/user/cart/cart.php'>sign out</a></td>";
	    echo "</table>". "<br>". "<br>";
	    $conn = new mysqli("localhost", "root", "mysql", "book_sales");
	    $lyn = $conn->query("select * FROM cart where member_id = '{$member_id}'");
	    echo "<table border=1 width='935'>";
	    echo "<tr><td>Delete</td><td>Update</td><td>Cart ID</td><td>Member ID</td><td>Total Price</td><td>Total Quantity</td><td>Create Time</td><td>Update Time</td><td>Cart Detail</td>";
	    for($i=0;$i<mysqli_num_rows($lyn);$i++){
	    	$lyn_arr = mysqli_fetch_array($lyn);
	        $cart_id = $lyn_arr['cart_id'];
	    	$total_price = $lyn_arr['total_price'];
	    	$total_quantity = $lyn_arr['total_quantity'];
	    	$create_time = $lyn_arr['create_time'];
	    	$update_time = $lyn_arr['update_time'];
	    	echo "<tr><td><a href = '/book_sales/user/cart/deleteCart.php'>Delete</a></td><td><a href = '/book_sales/user/cart/updateCart.php'>Update</a></td><td>$cart_id</td><td>$member_id</td><td>$total_price</td><td>$total_quantity</td><td>$create_time</td><td>$update_time</td><td><a href = '/book_sales/user/cart/oneCart.php?cart_id={$cart_id}'>Cart Detail</a></td>";	
	    }
	    echo "</table>". "<br>". "<br>";
		echo "<a href = '/book_sales/user/cart/checkOut.php'>Check out</a>". "<br>";
        mysqli_close($conn);
	}
?>
</center>