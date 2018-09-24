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
	Search For A Book:
<br>
<br>		
	<form name="Search" method="POST">
		   <table  width="960">
		       <tr>
			       <td><input type="submit" name="by_author" value="BY AUTHOR"></td>
				   <td><input type="submit" name="by_publisher" value="BY PUBLISHER"></td>				   	
				   <td><input type="submit" name="by_category" value="BY CATEGORY"></td>		
				   <td><input type="submit" name="by_year" value="BY PUBLISH YEAR"></td>		
			   </tr>
			</table>
	</form>
<br>
<br>	
	<?php	  
	  $member_id = $_SESSION['member_id'];
	  $conn=new mysqli("localhost", "root", "mysql", "book_sales");
      if(isset($_POST['by_author']))
	  {
         $qry="SELECT * FROM author";
		 $result=$conn->query($qry);		
		 echo "<table border=1 width='400'>";
		 while($row = mysqli_fetch_array($result))
		 {		      
			 $author_id = $row["author_id"];
			 $author_name = $row["author_name"];
			 $_SESSION['author_id'] = $row["author_id"];
			 echo "<tr><td><a href = '/book_sales/search/authorSearch.php?author_id={$author_id}'>$author_name</a></td><tr>";				 	
		 }
		 echo "</table>";		
	  }
      if(isset($_POST['by_category']))
	  {
         $lynn="SELECT * FROM `book` GROUP BY `category`";
		 $lyn=$conn->query($lynn);		
		 echo "<table border=1 width='950'>";
		 while($row = mysqli_fetch_array($lyn))
		 {		      
			 $category = $row["category"];
			 echo "<td><a href = '/book_sales/search/categorySearch.php?category={$category}'>$category</a></td>";		
		 }
		 echo "</table>";		
	  }
	  if(isset($_POST['by_publisher']))
	  {
         $sql="SELECT * FROM `publisher`";
		 $re=$conn->query($sql);		
		 echo "<table border=1 width='400'>";
		 while($row = mysqli_fetch_array($re))
		 {		      
			 $publisher_id = $row["publisher_id"];
			 $publisher_name = $row["publisher_name"];
			 echo "<tr><td><a href = '/book_sales/search/publisherSearch.php?publisher_id={$publisher_id}'>$publisher_name</a></td><tr>";		
		 }
		 echo "</table>";		
	  }
	  if(isset($_POST['by_year']))
	  {
         $sq="SELECT YEAR(publish_date) FROM `book` GROUP BY YEAR(publish_date)";
		 $res=$conn->query($sq);		
		 echo "<table border=1 width='935'>";
		 while($row = mysqli_fetch_array($res))
		 {		      
			 $year = $row[0];
			 echo "<td><a href = '/book_sales/search/yearSearch.php?year={$year}'>$row[0]</a></td>";		
		 }
		 echo "</table>";		
	  }
    ?>
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
<center>