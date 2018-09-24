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
      $sql = "";
      switch($_GET[action]){
        case 'month_2017': $sql = "SELECT MONTH(order_time) as n, count(*)/10 as t FROM `order` WHERE YEAR(order_time) = '2017' GROUP BY MONTH(order_time);";
        break;
        case 'annual': $sql = "SELECT YEAR(order_time) as n, count(*)/100 as t FROM `order` GROUP BY YEAR(order_time);";
        break;
		case 'profit': $sql = "SELECT b.book_id as n, SUM((b.price-b.original_price)*od.item_quantity)/1000 as t FROM order_detail od JOIN book b ON od.book_id = b.book_id GROUP BY b.book_id;";
        break;
        default:  $sql = "SELECT b.book_id as n, SUM((b.price-b.original_price)*od.item_quantity)/1000 as t FROM order_detail od JOIN book b ON od.book_id = b.book_id GROUP BY b.book_id;";
      }
      $result = $conn->query($sql);
      $output = "letter\tfrequency\n";
      if ($result){
        while($row = $result->fetch_assoc())
        {
            $output .= $row['n']."\t".$row['t']."\n"; 
        }
      }
      $result->free();
      echo $output;
      // Close connection
      mysqli_close($conn);
?>