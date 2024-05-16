<?php
    session_start();
    include 'DBConnection.php';
    $userID = $_SESSION['ID'];
    if (isset($_POST['submit'])){
        $amount = $_POST['amount'];
        $description = $_POST['description'];

        $query = "INSERT INTO `income_table` (`Amount`, `Datetime`, `Description`, `UserID`) VALUES ('$amount', NOW(), '$description','$userID')";

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
        <link rel="stylesheet" href="Income.css">
        <title>Insert Income</title>
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
            <h1>Insert Income</h1>
            <table class="insertIncome">
                <form action="InsertIncomePage.php" method="post">
                    <tr>
                        <th>Amount</th>
                        <td><input type="number" name="amount" required></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><textarea name="description" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;"><button type="submit" name="submit">Insert</button></td>
                    </tr>
                </form>
            </table>
        </div>    
    </body>

</html>
