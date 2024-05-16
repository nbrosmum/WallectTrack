<?php
@include 'DBConnection.php';
session_start();
if (isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $select = "SELECT * FROM `user_form` WHERE email = '$email' AND password ='$pass'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['ID'] = $row['id'];
        header('location:HP.php');
    }else{
        $error[] = 'incorrect email or password!';
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
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="form-container">

    <form action="" method="post">
        <h3>Login now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
        <input type="email" name="email" requried placeholder = "enter your email">
        <input type="password" name="password" requried placeholder = "enter your password">
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>Don't have an account? <a href="Register_FormPage.php"> Register now</a></p>
        <p>Forget Password? <a href="ForgetPassword.php"> Reset now</a></p>
    </form>

</div>

</body>
</html>