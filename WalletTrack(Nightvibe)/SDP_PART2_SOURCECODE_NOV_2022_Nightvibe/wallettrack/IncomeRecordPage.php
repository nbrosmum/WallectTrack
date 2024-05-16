<?php
    session_start();
    include 'DBConnection.php';
    $userID = $_SESSION['ID'];

    if(isset($_GET['month'])) {
        $month = $_GET['month'];
        if($month == "all"){
            $query = "SELECT * FROM `income_table` WHERE `UserID` = '$userID'";
            $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE UserID = '$userID'";
        }else{
            $query = "SELECT * FROM `income_table` WHERE `UserID` = '$userID' AND MONTH(`DateTime`) = '$month'";
            $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE MONTH(Datetime) = '$month'  AND UserID = '$userID'";
        }
    } else {
        $query = "SELECT * FROM `income_table` WHERE `UserID` = '$userID'";
        $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE UserID = '$userID'";
    }

    $result = mysqli_query($conn,$query);
    $total_I = mysqli_query($conn, $Income);
    $total_Irow = mysqli_fetch_assoc($total_I );
    $total_Iamount = $total_Irow['Total_IAmount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="WTS.ico">
    <link rel="stylesheet" href="Income.css">
    <title>Income Page</title>
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
        <h1>Income Record</h1>
        <table class="IncomeRecord">
            <tr>
                <form action="IncomeRecordPage.php" method="get">                    
                    <th colspan="2" style="text-align: end;"><label for="month">Select Month:</label></th>
                    <th><select name="month" id="month">
                    <?php if (isset($_GET['month'])) { ?>
                        <option value="all" <?php if(empty($month)) echo "selected" ?>>All</option>
                        <option value="01" <?php if($month=="01") echo "selected" ?>>January</option>
                        <option value="02" <?php if($month=="02") echo "selected" ?>>February</option>
                        <option value="03" <?php if($month=="03") echo "selected" ?>>March</option>
                        <option value="04" <?php if($month=="04") echo "selected" ?>>April</option>
                        <option value="05" <?php if($month=="05") echo "selected" ?>>May</option>
                        <option value="06" <?php if($month=="06") echo "selected" ?>>June</option>
                        <option value="07" <?php if($month=="07") echo "selected" ?>>July</option>
                        <option value="08" <?php if($month=="08") echo "selected" ?>>August</option>
                        <option value="09" <?php if($month=="09") echo "selected" ?>>September</option>
                        <option value="10" <?php if($month=="10") echo "selected" ?>>October</option>
                        <option value="11" <?php if($month=="11") echo "selected" ?>>November</option>
                        <option value="12" <?php if($month=="12") echo "selected" ?>>December</option>
                    <?php } else { ?>
                        <option value="all">All</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    <?php } ?>
                    </select></th>
                    <th><button type="submit">Filter</button></th>
                </form>
            </tr>
            <tr>
                <th>Amount</th>
                <th>DateTime</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){?>
                <tr>                    
                    <td><?php echo $row['Datetime'] ;?></td>
                    <td><?php echo $row['Description'] ;?></td>
                    <td><?php echo $row['Amount'] ;?></td>
                    <td>
                        <a href = "EditIncome.php?id=<?php echo $row['IncomeID'];?>">Edit</a> |
                        <a href = "DeleteIncome.php?id=<?php echo $row['IncomeID'];?>">Delete</a> 
                    </td>
                </tr>
            <?php } ?>
                <tr>
                    <td colspan="2" style="text-align: end;">Total Income:</td>
                    <td colspan="2" style="text-align: start;"><?php echo $total_Iamount; ?></td> 
                </tr>
        </table>
    </div>
</body>
</html>