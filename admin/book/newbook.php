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
		Add New book:		
		<form method="POST" enctype="multipart/form-data">			
		   <table>
		       <tr>
			       <td>Book Name: </td><td><input type="text" name="book_name"></td><tr>
			       <td>ISBN: </td><td><input type="number" name="book_isbn"></td><tr>
				   <td>Category: </td><td><input type="text" name="category"></td><tr>
				   <td>Author: </td><td><input type="text" name="author_name"></td><tr>
				   <td>Publisher: </td><td><input type="text" name="publisher_name"></td><tr>
				   <td>Publish Date: </td><td><input type="date" name="publish_date"></td><tr>
				   <td>Book Desc: </td><td><input type="text" name="book_desc"></td><tr>
                   <td>Edition: </td><td><input type="text" name="edition"></td><tr>
				   <td>Original Price: </td><td><input type="text" name="original_price"></td><tr>
				   <td>Price: </td><td><input type="text" name="price"></td><tr>
				   <td>Quantity: </td><td><input type="number" name="quantity"></td><tr>
				   <td>Image: </td><td><input type="file" name="image"></td><tr>
                   <td><input type="submit" name="submit" value="submit"></td>
			   </tr>
		    </table>
		</form>
  <?php
    if(isset($_POST['submit']))
	{
        $id=$_SESSION['id'];
		$book_name = $_POST['book_name'];
        $book_isbn = $_POST['book_isbn'];
		$category = $_POST['category'];
		$author_name = $_POST['author_name'];
		$publisher_name = $_POST['publisher_name'];
        $publish_date = $_POST['publish_date'];
        $book_desc = htmlspecialchars($_POST['book_desc'], ENT_QUOTES);			
        $edition = $_POST['edition'];
		$original_price = $_POST['original_price'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];	   	     
        $image=addslashes($_FILES['image']['tmp_name']);
		$image=file_get_contents($image);
		$image=base64_encode($image);
		
		$conn=new mysqli("localhost", "root", "mysql", "book_sales");
				
		//input new author into database
		$li = "SELECT * FROM `author` where author_name = '{$author_name}'";
        $liSet = $conn->query($li);
		if(mysqli_num_rows($liSet)>0){			
			echo "You have this author already";		
		}else{
		    $res=$conn->query("INSERT INTO `author` (`author_name`, `create_time`, `update_time`) values ('$author_name', now(), now())");	
		}
		
		//input new author into database
		$lil = "SELECT * FROM `publisher` where publisher_name = '{$publisher_name}'";
        $lilSet = $conn->query($lil);
		if(mysqli_num_rows($lilSet)>0){			
			echo "You have this publisher already";		
		}else{
		    $re=$conn->query("INSERT INTO `publisher` (`publisher_name`, `create_time`, `update_time`) values ('$publisher_name', now(), now())");	
		}
				
		$result=$conn->query("INSERT INTO `book` (`book_name`, `book_isbn`, `category`, `publish_date`, `book_desc`, `edition`, `price`, `original_price`, `quantity`, `image`, `create_time`, `update_time`) values ('$book_name', '$book_isbn', '$category', '$publish_date', '$book_desc', '$edition', '$price', '$original_price', '$quantity', '$image', now(), now())");			
		
		//locate book_id
        $ll=$conn->query("SELECT * FROM `book` WHERE `book_name`='{$book_name}' GROUP BY create_time DESC LIMIT 1");		
		$ll_arr = mysqli_fetch_assoc($ll);
        $book_id = $ll_arr['book_id'];
		
		//locate author_id
		$ry=$conn->query("SELECT * FROM `author` WHERE author_name='{$author_name}'");	
		$ry_arr = mysqli_fetch_assoc($ry);
        $author_id = $ry_arr['author_id'];	
		
		//insert new data into table book_author
		$lynn=$conn->query("INSERT INTO `book_author` (`book_id`, `author_id`) values ('$book_id', '$author_id')");	
		
		//locate publisher_id
		$lily=$conn->query("SELECT * FROM `publisher` WHERE publisher_name='{$publisher_name}' GROUP BY create_time DESC LIMIT 1");	
		$lily_arr = mysqli_fetch_assoc($lily);
        $publisher_id = $lily_arr['publisher_id'];
		
		//insert new data into table book_publisher
		$lyn=$conn->query("INSERT INTO `book_publisher` (`book_id`, `publisher_id`) values ('$book_id', '$publisher_id')");			
		
        if($result)
        {
	    	echo "Succesful! <a href='/book_sales/admin/admin.php'>Check the result</a>";
    	}else{
			echo "Something Wrong! <a href='/book_sales/admin/admin.php'>Try again</a>";
   	    }	
			
	}
    ?>
</center>
</body>
</html>