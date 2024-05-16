<?php
    session_start();
    Include 'DBConnection.php';
    if (isset($_POST['btnReset'])){
        $email= $_POST["txtEmail"];
        $query = "SELECT * FROM user_form WHERE email = '$email' ";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($results);
        $count = mysqli_num_rows($results);
        if ($count == 1){
            echo "record found!";
            $_SESSION["Email"] = $email;
            $_SESSION["Location"] = 'Login';
            header('Location:ResetPassword.php');
        }else{
            echo 'record not found!';
        }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="WTS.ico">
        <link rel="stylesheet" href="style.css">
        <title>Reset Password Page</title>
    </head>
    <body>
        <div class="form-container">
                <form action="#" method= "post">
                    <h1>Update Password</h1>
                    <input type="email" required placeholder="Email" name = "txtEmail" >
                    <button type = "submit" name = "btnReset" class="form-btn">confrim</button>
                    <p>Back to Login Page <a href="Login.php">Login here</a></p>
                </form>                
        </div>        
    </body>
</html>
