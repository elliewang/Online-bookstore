<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<?php
    session_start();
	if(!isset($_SESSION['id'])){
	     header("Location:http://localhost/book_sales/index.php");
	}
	echo "<table border=0 width='1000' height='50'>";
	echo "<tr><td><a href='/book_sales/admin/book/newbook.php'>Add a new book</a></td>";
	echo "<td><a href='/book_sales/admin/book/addAuthor.php'>Add a new Author</a></td>";
	echo "<td><a href='/book_sales/admin/book/addPublisher.php'>Add a new Publisher</a></td>";
	echo "<td><a href='/book_sales/admin/alterPswd.php'>Change your password</a></td>";
	echo "<td>Administrator ". $_SESSION['id']. ", <a href='/book_sales/exit.php'> Sign out</a></td>". "</br>";
	echo "</table>";
	echo "</br>";
?>
<!doctype html> 
<html> 
	<head> 
		<title>Welcome</title> 
	</head> 
<body> 
	<form name="Search" method="POST">
		   <table  width="960">
		       <tr>
			       <td><input type="submit" name="order" value="Order Information"></td>
				   <td><input type="submit" name="member" value="Member Information"></td>				   	
				   <td><input type="submit" name="book" value="Book Information"></td>		
			   </tr>
			</table>
	</form>
<br>	
<?php		
	// Get data      
	$id=$_SESSION['id'];
	// Create connection
	$mysql = new mysqli("localhost", "root", "mysql", "book_sales");
	// Check connection
	if ($mysql->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}  
	$sql = "SELECT * FROM `admin` where `admin_id` ='$id'";
	$result = $mysql->query($sql);
	if(mysqli_num_rows($result)>0){
			
		if(isset($_POST['order'])){			
            //Order Information
			$ql = $mysql->query("select * from `order`");
			echo "<table border=1 width='1000'>";
			echo "Order Information: <a href='/book_sales/admin/viz/viz.php'>Data Visualization</a>". "<br>". "<br>";
			echo "<tr><td>Cancel</td><td>Retrieve</td><td>Order Id</td><td>Member Id</td><td>Total Price</td><td>Order Time</td><td>Total Quantity</td><td>Status</td><td>Update Time</td><td>Order Detail</td></tr>";
            for($i=0;$i<mysqli_num_rows($ql);$i++){
                $ql_arr = mysqli_fetch_assoc($ql);
                $order_id = $ql_arr['order_id'];
                $member_id = $ql_arr['member_id'];	
                $total_price = $ql_arr['total_price'];
                $order_time = $ql_arr['order_time'];		
		    	$total_quantity = $ql_arr['total_quantity'];
                $status = $ql_arr['status'];
                $update_time = $ql_arr['update_time'];	
                // fill in table
                echo "<tr><td><a href = '/book_sales/admin/order/deleteOrder.php?order_id={$order_id}'>Cancel</td><td><a href = '/book_sales/admin/order/updateOrder.php?order_id={$order_id}'>Retrieve</td><td>$order_id</td><td>$member_id</td><td>$total_price</td><td>$order_time</td><td>$total_quantity</td><td>$status</td><td>$update_time</td><td><a href = '/book_sales/admin/order/orderDetail.php?order_id={$order_id}'>order detail</td></tr>";
            }
			echo "</table>". "<br>";
		}
		
		if(isset($_POST['member'])){				
            //Member Information
			$sq = $mysql->query("select * from member");
			echo "<table border=1 width='1000'>";
			echo "Member Information: ". "<br>". "<br>";
		    echo "<tr><td>Delete</td><td>Edit</td><td>Member Id</td><td>Member Name</td><td>Password</td><td>Street</td><td>City</td><td>State</td><td>Zipcode</td><td>Country</td><td>Phone Number</td><td>Email</td><td>Is Active</td><td>Is Deleted</td><td>Create Time</td><td>Update Time</td></tr>";
            for($i=0;$i<mysqli_num_rows($sq);$i++){
                $sq_arr = mysqli_fetch_assoc($sq);
                $member_id = $sq_arr['member_id'];
                $member_name = $sq_arr['member_name'];			
                $password = $sq_arr['password'];
                $street = $sq_arr['street'];
                $city = $sq_arr['city'];		
			    $state = $sq_arr['state'];
                $zipcode = $sq_arr['zipcode'];
                $country = $sq_arr['country'];	
		    	$phone_number = $sq_arr['phone_number'];
                $email = $sq_arr['email'];
                $is_active = $sq_arr['is_active'];
                $is_deleted = $sq_arr['is_deleted'];	
		    	$create_time = $sq_arr['create_time'];
                $update_time = $sq_arr['update_time'];	
				$_SESSION['member_id']=$member_id;
                // fill in table
                echo "<tr><td><a href = '/book_sales/admin/member/deleteMember.php?member_id={$member_id}'>Delete</td><td><a href = '/book_sales/admin/member/editMember.php?member_id={$member_id}'>Edit</td><td>$member_id</td><td>$member_name</td><td>$password</td><td>$street</td><td>$city</td><td>$state</td><td>$zipcode</td><td>$country</td><td>$phone_number</td><td>$email</td><td>$is_active</td><td>$is_deleted</td><td>$create_time</td><td>$update_time</td></tr>";
            }
			echo "</table>". "<br>";
		}
		
		if(isset($_POST['book'])){		
			//Book Information
			$sl = $mysql->query("select * from book");
			echo "Book Information: ". "<br>". "<br>";
			echo "<table border=1 width='1000'>";
			echo "<tr><td>Delete</td><td>Edit</td><td>Book Id</td><td>Book Name</td><td>ISBN</td><td>Category</td><td>Author</td><td>Publisher</td><td>Publish Date</td><td>Edition</td><td>Original Price</td><td>Price</td><td>Quantity</td><td>Image</td><td>Is Edited</td><td>Is Deleted</td><td>Create Time</td><td>Update Time</td></tr>";
       	    for($i=0;$i<mysqli_num_rows($sl);$i++){
                $sl_arr = mysqli_fetch_array($sl);
                $book_id = $sl_arr['book_id'];
                $book_name = $sl_arr['book_name'];			
                $book_isbn = $sl_arr['book_isbn'];	
				$category = $sl_arr['category'];	
			    $publish_date = $sl_arr['publish_date'];
                $edition = $sl_arr['edition'];
				$original_price = $sl_arr['original_price'];	
			    $price = $sl_arr['price'];
                $quantity = $sl_arr['quantity'];
                $image = $sl_arr['image'];
                $is_edited = $sl_arr['is_edited'];	
		    	$is_deleted = $sl_arr['is_deleted'];
		    	$create_time = $sl_arr['create_time'];
                $update_time = $sl_arr['update_time'];	
				$_SESSION['book_id']=$book_id;
				$lynn = $mysql->query("select * from author u JOIN book_author b ON u.author_id = b.author_id where b.book_id = '{$book_id}'");
				$lynn_arr = mysqli_fetch_array($lynn);
				$author_name = $lynn_arr['author_name'];
				
				$lily = $mysql->query("select * from publisher p JOIN book_publisher b ON p.publisher_id = b.publisher_id where b.book_id = '{$book_id}'");
				$lily_arr = mysqli_fetch_array($lily);
				$publisher_name = $lily_arr['publisher_name'];
                // fill in table
                echo "<tr><td><a href = '/book_sales/admin/book/deleteBook.php?book_id={$book_id}'>Delete</td><td><a href = '/book_sales/admin/book/editBook.php?book_id={$book_id}'>Edit</td><td>$book_id</td><td>$book_name</td><td>$book_isbn</td><td>$category</td><td>$author_name</td><td>$publisher_name</td><td>$publish_date</td><td>$edition</td><td>$original_price</td><td>$price</td><td>$quantity</td>";
				echo '<td><img width="150" height="200" src="data:image;base64,'.$sl_arr[9].'"></td>';
				echo "<td>$is_edited</td><td>$is_deleted</td><td>$create_time</td><td>$update_time</td></tr>";
            }
			echo "</table>";
		}
			
		}else{
		    echo "You haven't signed in, please <a href='/book_sales/admin/login.html'>sign in</a>";
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
</html></center> 
 