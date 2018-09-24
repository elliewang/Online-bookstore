<?php
    session_start();
?>
<center>
<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
  <?php
        $member_id = $_SESSION['member_id'];
        $mysql=new mysqli("localhost", "root", "mysql", "book_sales");
		
		$sq = $mysql->query("SELECT SUM(`total_price`) as total_price, SUM(`total_quantity`) as total_quantity FROM `cart` WHERE member_id ='{$member_id}'");
        $sq_arr = mysqli_fetch_array($sq);	
		$total_price = $sq_arr['total_price'];
		$total_quantity = $sq_arr['total_quantity'];
			
		$qry=$mysql->query("INSERT INTO `order` (`member_id`, `total_price`, `order_time`, `total_quantity`, `status`,  `update_time`) values('$member_id', '$total_price',  now(),'$total_quantity', '1', now())");	
				
		$sl = $mysql->query("SELECT * FROM `order` WHERE member_id ='{$member_id}' ORDER BY order_time DESC LIMIT 1");
		$sl_arr = mysqli_fetch_array($sl);			
		$order_id = $sl_arr['order_id'];
		echo $order_id;
			
		$ql = $mysql->query("SELECT book_id, item_quantity from cart_detail where cart_id IN (SELECT cart_id FROM cart WHERE member_id ='{$member_id}')");
		for($i=0;$i<mysqli_num_rows($ql);$i++){
			$ql_arr = mysqli_fetch_array($ql);			
			$book_id = $ql_arr['book_id'];
			$item_quantity = $ql_arr['item_quantity'];		
			$que=$mysql->query("INSERT INTO `order_detail` (`order_id`, `book_id`, `item_quantity`) values('$order_id', '$book_id', '$item_quantity')");
			//The quantity of book should be decrease by 1
			$lil = $mysql->query("SELECT `quantity` FROM `book` WHERE `book_id` = '{$book_id}'");
			$lil_arr = mysqli_fetch_array($lil);			
			$quantity = $lil_arr['quantity'];
			$quanti = $quantity-$item_quantity;	
			
			$lynn=$mysql->query("update `book` set `quantity`='{$quanti}', update_time = now() where `book_id` = '{$book_id}'");	
			$q=$mysql->query("DELETE FROM `cart_detail` WHERE book_id ='{$book_id}'");
		}		
				
        $l=$mysql->query("DELETE FROM `cart` WHERE member_id ='{$member_id}'");					
	    
        if($que)
        {     			
		    header('Location: http://localhost/book_sales/user/user.php');
        }else{
	    	echo "Something Wrong! <a href='/book_sales/user/user.php'>Try again</a>";
        }		
        mysqli_close($mysql);
?>
</center>