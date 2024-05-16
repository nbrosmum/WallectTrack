<?php
    session_start();
    include 'DBConnection.php';

    if(isset($_GET['id'])) {
        $incomeID = $_GET['id'];
        $query = "SELECT * FROM `income_table` WHERE `IncomeID` = '$incomeID'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
    }

    if(isset($_POST['update'])) {
        $incomeID = $_GET['id'];
        $amount = $_POST['amount'];
        $datetime = $_POST['datetime'];
        $description = $_POST['description'];
        $query = "UPDATE `income_table` SET `Amount`='$amount',`Datetime`='$datetime',`Description`='$description' WHERE `IncomeID`='$incomeID'";
        $result = mysqli_query($conn,$query);
        if($result) {
            header("Location: IncomeRecordPage.php");
        } else {
            echo "Update Failed";
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
    <link rel="stylesheet" href="Income.css">
    <title>Edit Income</title>
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
        <h1>Edit Income</h1>
        <table class="EditIncome">
            <form action="" method="post">
                <tr>
                    <th><label for="amount">Amount:</label></th>
                    <td><input type="number" name="amount" value="<?php echo $row['Amount'];?>" required></td>
                </tr>
                <tr>
                    <th><label for="datetime">Date and Time:</label></th>
                    <td><input type="datetime-local" name="datetime" value="<?php echo date('Y-m-d\TH:i:s',strtotime($row['Datetime']));?>" required></td>
                </tr>
                <tr>
                    <th><label for="description">Description:</label></th>
                    <td><input type="text" name="description" value="<?php echo $row['Description'];?>" required></td>
                </tr>
                <tr>
                    <td><a href="IncomeRecordPage.php">Back</a></td>
                    <td><button type="submit" name="update">Update</button></td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>