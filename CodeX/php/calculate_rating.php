<?php

    $sql = "SELECT AVG(rating_score) as x FROM rating WHERE admin_username='".$admin."'";

    $result_2 = $conn->query($sql);
    if($result_2){
      $row_2 = $result_2->fetch_assoc();
      $rating = (int)$row_2['x'];
    }
    else{
      $rating = 0;
    }
    if(!$rating){
      echo "-";
    }
    else{

      for ($x = 0; $x < $rating; $x++) {
        echo '<span class="fa fa-star checked"></span>';
      } 
      for ($x = 0; $x < 5-$rating; $x++) {
        echo '<span class="fa fa-star"></span>';
      } 
    }


?>