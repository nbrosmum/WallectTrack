<?php
       $conn = mysqli_connect('localhost','root' ,'','wallet_tracker');
   
       if ($conn === false){
           die('Error in the connection'.mysqli_connect_error());
       }
       
?>