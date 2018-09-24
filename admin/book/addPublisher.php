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
		Add New Publisher:		
		<form method="POST" enctype="multipart/form-data">			
		   <table>
		       <tr>
			       <td>Publisher Name: </td><td><input type="text" name="publisher_name"></td><tr>
                   <td><input type="submit" name="submit" value="submit"></td>
			   </tr>
		    </table>
		</form>
  <?php
    if(isset($_POST['submit']))
	{
        $id=$_SESSION['id'];
		$publisher_name = $_POST['publisher_name'];
		
        $conn=new mysqli("localhost", "root", "mysql", "book_sales");
        $qry="INSERT INTO `publisher` (`publisher_name`, `create_time`, `update_time`) values('$publisher_name', now(), now())";
        $result=$conn->query($qry);
        if($result)
        {
			$qry="SELECT * FROM `publisher`";
			$sql=$conn->query($qry);
			echo "<table border=1>";
			echo "<tr><td>Publisher Id</td><td>Publisher Name</td><td>Create Time</td><td>Update Time</td>";
			for($i=0;$i<mysqli_num_rows($sql);$i++){
                $sql_arr = mysqli_fetch_array($sql);
                $publisher_id = $sql_arr['publisher_id'];
                $publisher_name = $sql_arr['publisher_name'];			
                $create_time = $sql_arr['create_time'];			
                $update_time = $sql_arr['update_time'];
				echo "<tr><td>$publisher_id</td><td>$publisher_name</td><td>$create_time</td><td>$update_time</td>";
			}
			echo "</table>";
			echo "Succesful! <a href='/book_sales/admin/admin.php'>Back</a>";
        }else{
		    echo "Something Wrong! <a href='/book_sales/admin/admin.php'>Try again</a>";
        }
        mysqli_close($conn);
	}
  ?>
</center>
</body>
</html>