<?php
session_start();
include "DBConnection.php";

if(isset($_POST['btnUpdate'])){
    $email = $_SESSION["Email"];
    $pass = $_POST["txtPassword"];
    $CPassword = $_POST['txtCPassword'];
    $Location = $_SESSION["Location"];
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        $symbol = preg_match('@[^\w]@', $pass);
        if(empty($pass)){
            echo "<script>alert('Please enter a password')</script>";
         }else if(!$uppercase || !$lowercase || !$number || !$symbol || strlen($pass) < 8 || strlen($pass) > 12) {
           echo '<script>alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, one symbol, and be 8-12 characters long")</script>';
         } else {
           $Password = $_POST['txtPassword'];
           $CPassword = $_POST['txtCPassword'];
           if ($Password != $CPassword) {
              echo '<script>alert("Password doesn`t match!!!")</script>';
           } else {
              $query = "UPDATE `user_form` SET `password` = '$pass' WHERE email = '$email' ";
              if (mysqli_query($conn, $query)){
                  if($Location == "Login"){
                     header('location:Login.php');
                  } else if($Location == "Profile"){
                     header('location:Profile.php');
                  }
              } else {
                  echo"Sorry, record was not successful in updating";
              }
           }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="WTS.ico">
   <link rel="stylesheet" href="style.css">
   <title>Reset Password Page</title>
</head>
<body>
   <div class="form-container">
   <form action="ResetPassword.php" method= "post">
      <h1>Update Password</h1>
      <input type="password"  placeholder="Password" name = "txtPassword" id ="txtPassword">
      <input type="password"  placeholder="Re-Enter Password" name = "txtCPassword" id = "txtCPassword" >
      <button type = "submit" name = "btnUpdate">Update</button>
      <?php if($_SESSION["Location"] == "Login"){?>
         <p>Back to Login Page <a href="Login.php">Login here</a></p>
      <?php }else if ($_SESSION["Location"] == "Profile"){ ?>
         <button type="button" onclick="window.location.href='Profile.php'">Cancel</button>  
      <?php }else{ ?>
         <p>Error: Invalid Location.</p>
      <?php } ?>
   </form>         
  </div>   
</body>
</html>
