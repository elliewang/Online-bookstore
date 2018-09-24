<html>
<body>
<form method="post" enctype="multipart/form-data">
<br/>
<input type="file" name="image">
<input type="submit" name="submit" value="upload">
</form>
<?php
    if(isset($_POST['submit']))
	{
	    $image=addslashes($_FILES['image']['tmp_name']);
		//$name=addslashes($_FILES['image']['name']);
		$image=file_get_contents($image);
		$image=base64_encode($image);
		saveimage($name, $image);
	}
	displayimage();
	function saveimage($name, $image)
	{
	     $conn=new mysqli("localhost", "root", "mysql", "booksales");
		 $qry="insert into image(name, image) values('$name', '$image')";
		 $result=$conn->query($qry);
		 if($result)
		 {
		     //echo "Image uploaded.";
		 }else{
		     //echo "Image not uploaded.";
		 }
	}
	function displayimage()
	{
	     $conn=new mysqli("localhost", "root", "mysql", "booksales");
		 $qry="select * from image";
		 $result=$conn->query($qry);
		 while($row = mysqli_fetch_array($result))
		 {
		      echo '<img src="data:image;base64,'.$row[2].'">';
			  //echo $row[2];
		 }
		 mysqli_close($conn);
	}
?>