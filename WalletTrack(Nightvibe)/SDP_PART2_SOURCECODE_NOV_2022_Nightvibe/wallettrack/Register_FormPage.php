<?php
@include 'DBConnection.php';
if (isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $symbol = preg_match('@[^\w]@', $pass);

    if (!$uppercase || !$lowercase || !$number || !$symbol || strlen($pass) < 8 || strlen($pass) > 12) {
        echo '<script>alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, one symbol, and be 8-12 characters long")</script>';
    } else {
        $select = "SELECT * FROM `user_form` WHERE email = '$email' AND password ='$pass'";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            $error[] = 'user already exist!';
        } else {
            if ($pass != $cpass) {
                $error[] = 'password not matches';
            } else {
                $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
                mysqli_query($conn, $insert);
                header('location:Login.php');
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
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
<div class="form-container">

    <form action="" method="post">
        <h3>Register now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
        <input type="text" name="name" required placeholder = "enter your name">
        <input type="email" name="email" required placeholder = "enter your email">
        <input type="password" name="password" required placeholder = "enter your password">
        <input type="password" name="cpassword" required placeholder = "confirm your password">
        <input type="submit" name="submit" value="register now" class="form-btn">
        <p>already have an account? <a href="Login.php"> login now</a></p>
    </form>

</div>

</body>
</html>