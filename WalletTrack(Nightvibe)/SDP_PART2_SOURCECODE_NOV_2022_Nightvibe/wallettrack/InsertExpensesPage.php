<?php
    session_start();
    include 'DBConnection.php';

    $userID = $_SESSION['ID'];

    if (isset($_POST['submit'])){
        $expenses_type = $_POST['expenses_type'];
        $amount = $_POST['amount'];
        $description = $_POST['description'];

        $query = "INSERT INTO `expenses_table` (`Expenses_Type`, `Amount`, `DateTime`, `Description`,`UserID`) VALUES ('$expenses_type', '$amount', NOW(), '$description','$userID')";

        if (mysqli_query($conn, $query)){
            echo "Record added successfully!";
        } else {
            echo "Error adding record: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/x-icon" href="WTS.ico">
        <link rel="stylesheet" href="Expense.css">
        <title>Insert Expenses</title>
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
        <h1>Add Expenses</h1>
        <table class="InsertExpense">
        <form action="InsertExpensesPage.php" method="post">
            <tr>
                <th>Expenses Type</th>
                <td>
                    <select name="expenses_type" required>
                        <option value="">Select Expenses Type</option>
                        <option value="Food">Food</option>
                        <option value="Groceries">Groceries</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Rent">Rent</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Other">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>
                    <input type="number" name="amount" required>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea name="description" required></textarea>
                </td>
            </tr>
            <tr>
                <th colspan="2"><button type="submit" name="submit">Add Expenses</button></th>
            </tr>
        </form>
        </table>
    </div>
    </body>
</html>
