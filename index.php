<center>
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
		echo "<tr><td>Adminstrator $id</td><td><a href='/book_sales/admin/admin.php'>Account</a></td><td><a href='/book_sales/exit.php'>Sign out</a></td><tr>";
		echo "</table>";
	}
?>
<html>
<body>
<br>
<embed type="application/x-shockwave-flash" width="960"  height="100" src="http://localhost/book_sales/pic/banner.swf" quality="high"></embed>
<br><embed type="application/x-shockwave-flash"    width="950"    height="500"    src="http://localhost/book_sales/pic/ad.swf"    quality="high"></embed>
<br><embed type="application/x-shockwave-flash"    width="960"    height="80"    src="http://localhost/book_sales/pic/ad2.swf"    quality="high"></embed>
<br>
<br>
<?php
	     $conn=new mysqli("localhost", "root", "mysql", "book_sales");
		 $qry="select * from book order by create_time DESC LIMIT 6";
		 $result=$conn->query($qry);
		 echo "<table border=1>";
		 while($row = mysqli_fetch_array($result))
		 {		      
			  echo '<td><img width="150" height="200" src="data:image;base64,'.$row[9].'"></td>';		
		 }
		 echo "</table>";
?>
<?php
		 $sql="select * from book order by create_time DESC LIMIT 6";
		 $sq=$conn->query($sql);
		 echo "<table border='0' width='935' height='30'>";
		 while($row = mysqli_fetch_array($sq))
		 {	
			 $book_id = $row["book_id"];
			 echo "<td><a href = '/book_sales/book.php?book_id={$book_id}'>Book Detail</a></td>"; 		
		 }
		 echo '</table>'. "<br>";
?>
<embed type="application/x-shockwave-flash"    width="960"    height="80"    src="http://localhost/book_sales/pic/ad3.swf"    quality="high"></embed>
<?php
		 $sql="select * from order_detail Group by book_id ORDER BY SUM(`item_quantity`) DESC LIMIT 6";
		 $result=$conn->query($sql);
		 echo "<table border=1>";
		 while($row = mysqli_fetch_array($result))
		 {		      
			  $sq="select * from book WHERE book_id = '{$row[2]}'";
			  $re=$conn->query($sq);
			  while($ro = mysqli_fetch_array($re))
			  {
			      echo '<td><img width="150" height="200" src="data:image;base64,'.$ro[9].'"></td>';
			  }	  
		 }
		 echo "</table>";
?>
<?php
		 $sl="select * from order_detail Group by book_id ORDER BY SUM(`item_quantity`) DESC LIMIT 6";
		 $ql=$conn->query($sl);
		 echo "<table border='0' width='935' height='30'>";
			 while($row = mysqli_fetch_array($ql))
		 {	
			 $book_id = $row["book_id"];
			 echo "<td><a href = '/book_sales/book.php?book_id={$book_id}'>Book Detail</a></td>"; 		
		 }
		 echo '</table>'. "<br>";
		 mysqli_close($conn);
?>
<table width = "940">
<tr><td>Websites Links: </td></tr>
<br>
<tr><td><a href = 'https://www.amazon.com/books-used-books-textbooks/b/ref=nav_shopall_bo_t3?ie=UTF8&node=283155'>Books at Amazon</a></td><td><a href = 'http://www.sellbackyourbook.com/'>Sell Back Your book</a></td><td><a href = 'https://www.barnesandnoble.com/'>Barnes Noble</a></td><td><a href = 'https://www.alibris.com/books'>Alibris</a></td><td><a href = 'https://www.hpb.com/home'>Half Price</a></td><td><a href = 'https://www.thriftbooks.com/'>Thrift Books</a></td><td><a href = 'http://www.powells.com/'>Powell's City of Books</a></td></tr>
</table>
<br>
<br>
</body>
</center>
