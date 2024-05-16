<?php
    session_start();
    include 'DBConnection.php';

    if(isset($_GET['id'])) {
        $expensesID = $_GET['id'];
        $query = "SELECT * FROM `expenses_table` WHERE `ExpensesID` = '$expensesID'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
    }

    if(isset($_POST['update'])) {
        $expensesID = $_GET['id'];
        $expenses_type = $_POST['expenses_type'];
        $amount = $_POST['amount'];
        $datetime = $_POST['datetime'];
        $description = $_POST['description'];
        $query = "UPDATE `expenses_table` SET `Expenses_Type`='$expenses_type',`Amount`='$amount',`DateTime`='$datetime',`Description`='$description' WHERE `ExpensesID`='$expensesID'";
        $result = mysqli_query($conn,$query);
        if($result) {
            header("Location: ExpensesRecordPage.php");
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
    <link rel="stylesheet" href="Expense.css">
    <title>Edit Expenses</title>
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
        <h1>Edit Expenses</h1>
        <table class="EditExpense">
            <form action="" method="post">
                <tr>
                    <th><label for="expenses_type">Expenses Type:</label></th>
                    <td>
                        <select name="expenses_type" required>
                            <option value="">Select Expenses Type</option>
                            <option value="Food" <?php if($row['Expenses_Type'] == "Food") echo "selected"; ?>>Food</option>
                            <option value="Groceries" <?php if($row['Expenses_Type'] == "Groceries") echo "selected"; ?>>Groceries</option>
                            <option value="Entertainment" <?php if($row['Expenses_Type'] == "Entertainment") echo "selected"; ?>>Entertainment</option>
                            <option value="Rent" <?php if($row['Expenses_Type'] == "Rent") echo "selected"; ?>>Rent</option>
                            <option value="Transportation" <?php if($row['Expenses_Type'] == "Transportation") echo "selected"; ?>>Transportation</option>
                            <option value="Utilities" <?php if($row['Expenses_Type'] == "Utilities") echo "selected"; ?>>Utilities</option>
                            <option value="Other" <?php if($row['Expenses_Type'] == "Other") echo "selected"; ?>>Other</option>
                        </select>
                    </td>
                </tr>  
                <tr>
                    <th><label for="amount">Amount:</label></th>
                    <td>
                        <input type="number" name="amount" value="<?php echo $row['Amount'];?>" required>
                    </td>
                </tr>
                <tr>
                    <th><label for="datetime">Date and Time:</label></th>
                    <td>
                        <input type="datetime-local" name="datetime" value="<?php echo date('Y-m-d\TH:i:s',strtotime($row['DateTime']));?>" required>
                    </td>
                </tr>
                <tr>
                    <th><label for="description">Description:</label></th>
                    <td>
                        <input type="text" name="description" value="<?php echo $row['Description'];?>" required><br>
                    </td>
                </tr>
                <tr>
                    <td><a href="ExpensesRecordPage.php">Back</a></td>
                    <td><button type="submit" name="update">Update</button></td>
                </tr>   
            </form>
        </table>
    </div>
</body>
</html>
