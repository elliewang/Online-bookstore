<?php
    session_start();
?>
<html>
<center>
<body>
	<center>
	<embed type="application/x-shockwave-flash"    width="960"    height="100"    src="http://localhost/book_sales/pic/banner.swf"    quality="high"></embed>
<br>
<br>
		Add New Author:		
		<form method="POST" enctype="multipart/form-data">			
		   <table>
		       <tr>
			       <td>Author Name: </td><td><input type="text" name="author_name"></td><tr>
                   <td><input type="submit" name="submit" value="submit"></td>
			   </tr>
		    </table>
		</form>
  <?php
    if(isset($_POST['submit']))
	{
        $id=$_SESSION['id'];
		$author_name = $_POST['author_name'];
		
        $conn=new mysqli("localhost", "root", "mysql", "book_sales");
        $qry="INSERT INTO `author` (`author_name`, `create_time`, `update_time`) values('$author_name', now(), now())";
        $result=$conn->query($qry);
        if($result)
        {
		    $qry="SELECT * FROM `author`";
			$sql=$conn->query($qry);
			echo "<table border=1>";
			echo "<tr><td>Author Id</td><td>Author Name</td><td>Create Time</td><td>Update Time</td>";
			for($i=0;$i<mysqli_num_rows($sql);$i++){
                $sql_arr = mysqli_fetch_array($sql);
                $author_id = $sql_arr['author_id'];
                $author_name = $sql_arr['author_name'];			
                $create_time = $sql_arr['create_time'];			
                $update_time = $sql_arr['update_time'];
				echo "<tr><td>$author_id</td><td>$author_name</td><td>$create_time</td><td>$update_time</td>";
			}
			echo "Succesful! <a href='/book_sales/admin/admin.php'>Back</a>";
			echo "</table>";
        }else{
		    echo "Something Wrong! <a href='/book_sales/admin/admin.php'>Try again</a>";
        }
        mysqli_close($conn);
	}
  ?>
</center>
</body>
</html>