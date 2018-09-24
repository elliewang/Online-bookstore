<?php
      $servername = "localhost";
      $username = "root";
      $password = "mysql";
      $database = "book_sales";
      $conn = new mysqli($servername, $username, $password, $database);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
	  $id = $_GET['id'];
	  if($id == '1'){
	      $result = $conn->query("SELECT MONTH(order_time) as n, count(*)/10 as t FROM `order` WHERE YEAR(order_time) = '2017' GROUP BY MONTH(order_time)");
		  while($row=mysqli_fetch_array($result)){
             $str = $row['n'].",".$row['t']."\n"; 
			 $filename = date('Ymd').'.csv'; 
			 export_csv($filename,$str); 
		  }
	  }
	  if($id == '2'){
	      $result = $conn->query("SELECT YEAR(order_time) as n, count(*)/100 as t FROM `order` GROUP BY YEAR(order_time)");
          while($row=mysqli_fetch_array($result)){
             $str = $row['n'].",".$row['t']."\n"; 
	         $filename = date('Ymd').'.csv'; 
	         export_csv($filename,$str); 
		  }
	  }	  
	  if($id == '3'){
	      $result = $conn->query("SELECT b.book_name as n, SUM((b.price-b.original_price)*od.item_quantity)/1000 as t FROM order_detail od JOIN book b ON od.book_id = b.book_id GROUP BY b.book_id");
          while($row=mysqli_fetch_array($result)){
             $str = $row['n'].",".$row['t']."\n"; 
	         $filename = date('Ymd').'.csv'; 
	         export_csv($filename,$str); 
		  }
	  }	  
	  function export_csv($filename,$data) {
	  header("Content-type:text/csv");
	  header("Content-Disposition:attachment;filename=".$filename);
	  header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	  header('Expires:0');
	  header('Pragma:public');
	  echo $data;
}
?>