<?php
session_start();
include "DBConnection.php";
$user_id = $_SESSION['ID'];
$sql = "SELECT * FROM user_form WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];
$name = $row['name'];
$_SESSION['Location'] = 'Profile';

if(isset($_POST['edit_email'])) {
  $email_edit = true;
} else {
  $email_edit = false;
}

if(isset($_POST['edit_name'])) {
  $name_edit = true;
} else {
  $name_edit = false;
}

if(isset($_POST['email_submit'])) {
  $email = $_POST['email'];
  $sql = "UPDATE user_form SET email = '$email' WHERE id = $user_id";
  mysqli_query($conn, $sql);
  $email_edit = false;
}

if(isset($_POST['name_submit'])) {
  $name = $_POST['name'];
  $sql = "UPDATE user_form SET name = '$name' WHERE id = $user_id";
  mysqli_query($conn, $sql);
  $name_edit = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="WTS.ico">
    <link rel="stylesheet" href="Profile.css">
    <title>User Profile</title>
</head>
<body>
  <div class="wrapper">
        <div class="sidebar">
            <img src="WTS.png"> 
            <h2>Wallet<span>Track</span></h2>
            <ul>
                <li><a href="HP.php">Home</a></li>
                <li><a href="InsertIncomePage.php">Insert Income</a></li>
                <li><a href="IncomeRecordPage.php">Income Record</a></li>
                <li><a href="InsertExpensesPage.php">Insert Expenses</a></li>
                <li><a href="ExpensesRecordPage.php">Expenses Record</a></li>
                <li><a href="Profile.php">Profile</a></li>
                <li><a href="Logout.php">Log out</a></li>
            </ul>
	    </div>
  </div>
  <div class="left">
    <h1>User Profile</h1>
    <table class="Profile">
      <tr>    
        <!-- Email Section -->
        <?php if(!$email_edit) { ?>
          <th>Email:</th>
          <td><?php echo $email; ?></td>
          <td>
            <form method="POST">
                <input type="submit" name="edit_email" value="Edit Email">
            </form>
          </td>  
            <?php } else { ?>
            <form method="POST">
              <th>Email:</th>  
              <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
              <td><input type="submit" name="email_submit" value="Confirm"></td>
            </form>
        <?php } ?>
      </tr>
      <tr>
        <!-- Name Section -->
        <?php if(!$name_edit) { ?>
          <th>Name:</th>
          <td><?php echo $name; ?></td>          
          <td>
            <form method="POST">
                <input type="submit" name="edit_name" value="Edit Name">
            </form>
          </td>  
            <?php } else { ?>
            <form method="POST">
              <th>Name:</th>
                <td><input type="password" name="name" value="<?php echo $name; ?>"></td>
                <td><input type="submit" name="name_submit" value="Confirm"></td>
            </form>
            <?php } ?>
          </td>
      </tr>
      <tr>
        <td colspan="3">  
          <form method="POST" action="ResetPassword.php">
            <input type="submit" name="change_password" value="Change Password">
          </form>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>