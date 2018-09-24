<?php
    session_start();
?>
<html>
<head>
	<title>
		Membership Information
	</title>
</head>
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<body>	
<?php	   
	if(!isset($_SESSION['member_id']))
	{
		header("Location: http://localhost/book_sales/index.php");
	}			
	$member_id = $_SESSION['member_id'];
	$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
	if ($mysql->connect_error) {
		die("Connection failed: " . $mysql->connect_error);
	} 
	echo "<p><font color=\"red\">Connected successfully</font></p>";

	$lily = $mysql->query("select * from `member` where `member_id`='{$member_id}'");
	$lily_arr = mysqli_fetch_array($lily);
	$is_deleted = $lily_arr['is_deleted'];
	if($is_deleted=='1'){
	echo "You account is deleted, please <a href='/book_sales/user/register.html'>sign up a new account</a>";
	}else{		
		// Check connection
		echo "<table border=0 width='400' height='35'>";
		echo "<tr><td><a href='/book_sales/search.php'>Search for a book</a></td><td>Member $member_id, <a href='/book_sales/exit.php'>Sign out</a></td>". "</br>";
		echo "</table>". "<br>";
		echo "</br>";
		// Run a sql and get data from table student	
		$sq = $mysql->query("select * from `member` where `member_id`='{$member_id}'");
		echo "<table border=1 width='935'>";
		echo "Membership Information". "<br>". "<br>";	
		echo "<tr><td>Delete</td><td>Edit</td><td>Member Id</td><td>Member Name</td><td>Password</td><td>Question</td><td>Answer</td><td>Street</td><td>City</td><td>State</td><td>Zipcode</td><td>Country</td><td>Phone Number</td><td>Email</td><td>Is Active</td><td>Is Deleted</td><td>Create Time</td><td>Update Time</td></tr>";
        $sql_arr = mysqli_fetch_assoc($sq);
		$member_id = $sql_arr['member_id'];
        $member_name = $sql_arr['member_name'];			
        $password = $sql_arr['password'];
		$question = $sql_arr['question'];
		$answer = $sql_arr['answer'];
        $street = $sql_arr['street'];
            $city = $sql_arr['city'];	
			$state = $sql_arr['state'];
			$zipcode = $sql_arr['zipcode'];
            $country = $sql_arr['country'];
            $phone_number = $sql_arr['phone_number'];	
			$email = $sql_arr['email'];
            $is_active = $sql_arr['is_active'];
            $is_deleted = $sql_arr['is_deleted'];		
			$create_time = $sql_arr['create_time'];
            $update_time = $sql_arr['update_time'];	
            // fill in table
            echo "<tr><td><a href = '/book_sales/user/member/deleteMember.php'>Delete</a></td><td><a href = 'member/editMember.php'>Edit</a></td><td>$member_id</td><td>$member_name</td><td>$password</td><td>$question</td><td>$answer</td><td>$street</td><td>$city</td><td>$state</td><td>$zipcode</td><td>$country</td><td>$phone_number</td><td>$email</td><td>$is_active</td><td>$is_deleted</td><td>$create_time</td><td>$update_time</td></tr>";
			echo "</table>". "<br>". "<br>";
			
			$ql = $mysql->query("SELECT * FROM `order` WHERE `member_id` = '{$member_id}'");
			echo "My Order". "<br>". "<br>";
			echo "<table border=1  width='935'>";
			echo "<tr><td>Cancel</td><td>Retrieve</td><td>Order Id</td><td>Member Id</td><td>Total Price</td><td>Order Time</td><td>Total Quantity</td><td>Status</td><td>Update_time</td><td>Order Detail</td></tr>";
			for($i=0;$i<mysqli_num_rows($ql);$i++){
                $sq_arr = mysqli_fetch_array($ql);
                $order_id = $sq_arr['order_id'];
                $member_id = $sq_arr['member_id'];	
		    	$total_price = $sq_arr['total_price'];
		    	$order_time = $sq_arr['order_time'];
                $total_quantity = $sq_arr['total_quantity'];
                $status = $sq_arr['status'];		
                $update_time = $sq_arr['update_time'];	
								
                // fill in table
                echo "<tr><td><a href = '/book_sales/user/order/deleteOrder.php?order_id={$order_id}'>Cancel</td><td><a href = '/book_sales/user/order/retrieveOrder.php?order_id={$order_id}'>Retrieve</td><td>$order_id</td><td>$member_id</td><td>$total_price</td><td>$order_time</td><td>$total_quantity</td><td>$status</td><td>$update_time</td><td><a href = '/book_sales/user/order/orderDetail.php?order_id={$order_id}'>order detail</td></tr>";
			}
			echo "</table>". "<br>". "<br>";
			
			$lyn = $mysql->query("select * FROM cart where member_id = '{$member_id}'");
			echo "My Cart". "<br>". "<br>";
	        echo "<table border=1 width='935'>";
	        echo "<tr><td>Cancel</td><td>Cart ID</td><td>Member ID</td><td>Total Price</td><td>Total Quantity</td><td>Create Time</td><td>Update Time</td><td>Cart Detail</td>";
	        for($i=0;$i<mysqli_num_rows($lyn);$i++){
	    	    $lyn_arr = mysqli_fetch_array($lyn);
	            $cart_id = $lyn_arr['cart_id'];
	        	$total_price = $lyn_arr['total_price'];
	        	$total_quantity = $lyn_arr['total_quantity'];
	        	$create_time = $lyn_arr['create_time'];
	        	$update_time = $lyn_arr['update_time'];
	        	echo "<tr><td><a href = '/book_sales/user/cart/deleteCart.php?cart_id={$cart_id}'>Cancel</a></td><td>$cart_id</td><td>$member_id</td><td>$total_price</td><td>$total_quantity</td><td>$create_time</td><td>$update_time</td><td><a href = '/book_sales/user/cart/oneCart.php?cart_id={$cart_id}'>Cart Detail</a></td>";	
	        }
			
	        echo "</table>";
			echo "<a href = '/book_sales/user/cart/checkOut.php'>Check out</a>". "<br>";
			echo "<br>". "<br>";	
	}
?>
<br>
<table width = "940">
<tr><td>Websites Links: </td></tr>
<br>
<tr><td><a href = 'https://www.amazon.com/books-used-books-textbooks/b/ref=nav_shopall_bo_t3?ie=UTF8&node=283155'>Books at Amazon</a></td><td><a href = 'http://www.sellbackyourbook.com/'>Sell Back Your book</a></td><td><a href = 'https://www.barnesandnoble.com/'>Barnes Noble</a></td><td><a href = 'https://www.alibris.com/books'>Alibris</a></td><td><a href = 'https://www.hpb.com/home'>Half Price</a></td><td><a href = 'https://www.thriftbooks.com/'>Thrift Books</a></td><td><a href = 'http://www.powells.com/'>Powell's City of Books</a></td></tr>
</table>
<br>
<br>
</body>
</center>
</html>