<center>
<?php
    session_start();
	if(!isset($_SESSION['id'])){
		if(!isset($_SESSION['member_id'])){
			header('Location: http://localhost/book_sales/user/login.html');
		}else{
			$member_id=$_SESSION['member_id'];
			echo "<td>User $member_id, <a href='/book_sales/exit.php'>Sign out</a></td>". "</br>";
		}
	}else{
	header('Location: http://localhost/book_sales/user/login.html');
	}
?>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<?php		
	$book_id = $_GET['book_id'];
	$number = $_POST['number'];
	if($number <1){
		echo "<br>". "<br>";
		echo "Please input a valid number.";
	}else{				
		$conn = new mysqli("localhost", "root", "mysql", "book_sales");	
		$lily = $conn->query("SELECT * FROM `book` WHERE book_id ='{$book_id}'");
		$lily_arr = mysqli_fetch_array($lily);			
		$quantity = $lily_arr['quantity'];
		if($quantity =="0"){
		    echo "The storage is 0, <a href='/book_sales/search.php'>choose another book</a>";
		}else{	
	    	$lyn = $conn->query("select * FROM book where book_id = '{$book_id}'");
	    	$lyn_arr = mysqli_fetch_array($lyn);
	        $price = $lyn_arr['price'];
			$total_price = $price*$number;
	        $sql = $conn->query("INSERT INTO `cart` (`member_id`, `total_price`, `total_quantity`, `create_time`, `update_time`) values('$member_id', '$total_price', '$number', now(), now())");
		
	    	$sl = $conn->query("SELECT * FROM `cart` WHERE member_id ='{$member_id}' AND `total_price`='{$total_price}' AND total_quantity='{$number}'");
	    	$sl_arr = mysqli_fetch_array($sl);
		    $cart_id = $sl_arr['cart_id'];
		
		    $ql = $conn->query("INSERT INTO `cart_detail` (`cart_id`, `book_id`, `item_quantity`) values('$cart_id', '$book_id', '$number')");	
	   		if($ql)
       		{
			    header('Location: http://localhost/book_sales/user/user.php');
    	    }else{
             	echo "Something Wrong! <a href='/book_sales/search.php'>Try again</a>";
            }
		}					
        mysqli_close($conn);
	}
?>
</center>