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
<table width = "500">
<tr><td>Company's Name: </td><td> Lynn&Lily Bookstore</td></tr>
<br>
<tr><td>Our Address:  </td><td> 234 Centre Ave, Pittsburgh, PA, 15213</td></tr>
<br>
<tr><td>Tel:  </td><td> 4129876543</td></tr>
<br>
<tr><td>Email:  </td><td> Lynn&Lily@gmail.com </td></tr>
<br>
<br>
<br>
<br>
<br>
<br>
<table width = "940">
<tr><td>Websites Links: </td></tr>
<br>
<tr><td><a href = 'https://www.amazon.com/books-used-books-textbooks/b/ref=nav_shopall_bo_t3?ie=UTF8&node=283155'>Books at Amazon</a></td><td><a href = 'http://www.sellbackyourbook.com/'>Sell Back Your book</a></td><td><a href = 'https://www.barnesandnoble.com/'>Barnes Noble</a></td><td><a href = 'https://www.alibris.com/books'>Alibris</a></td><td><a href = 'https://www.hpb.com/home'>Half Price</a></td><td><a href = 'https://www.thriftbooks.com/'>Thrift Books</a></td><td><a href = 'http://www.powells.com/'>Powell's City of Books</a></td></tr>
</table>
<br>
<br>
</center>