<?php
    session_start();
    include "DBConnection.php";
    $userID = $_SESSION['ID'];
    if(isset($_GET['month'])) {
        $month = $_GET['month'];
        if ($month == "all") {
            $query = "SELECT Expenses_Type, SUM(Amount) AS total FROM expenses_table WHERE UserID = '$userID' GROUP BY Expenses_Type";
            $Expenses = "SELECT SUM(Amount) as Total_EAmount FROM expenses_table WHERE UserID = '$userID'";
            $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE UserID = '$userID'";
        } else {
            $query = "SELECT Expenses_Type, SUM(Amount) AS total FROM expenses_table WHERE MONTH(Datetime) = '$month' AND UserID = '$userID' GROUP BY Expenses_Type";
            $Expenses = "SELECT SUM(Amount) as Total_EAmount FROM expenses_table WHERE MONTH(DateTime) = '$month'  AND UserID = '$userID'";
            $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE MONTH(Datetime) = '$month'  AND UserID = '$userID'";
        }
    } else {
        $query = "SELECT Expenses_Type, SUM(Amount) AS total FROM expenses_table WHERE MONTH(Datetime) = MONTH(CURRENT_DATE()) AND UserID = '$userID' GROUP BY Expenses_Type";
        $Expenses = "SELECT SUM(Amount) as Total_EAmount FROM expenses_table WHERE MONTH(DateTime) = MONTH(CURRENT_DATE()) AND UserID = '$userID'";
        $Income = "SELECT SUM(Amount) as Total_IAmount FROM income_table WHERE MONTH(Datetime) = MONTH(CURRENT_DATE()) AND UserID = '$userID'";
    }
    $result = mysqli_query($conn, $query);
    $data = array();
    $data[] = ['Expenses_Type', 'total'];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [$row['Expenses_Type'], (int) $row['total']];
    }
    $json_data = json_encode($data);

   
    $total_E = mysqli_query($conn, $Expenses);
    $total_Erow = mysqli_fetch_assoc($total_E );
    $total_Eamount = $total_Erow['Total_EAmount'];
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="HP.css">

    <title>WalletTrack</title>
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
        <h3>Expenses Chart</h3>
        <form action="HP.php" method="get">
        <div class="top">
            <div class="graph">
                <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(<?php echo $json_data; ?>);
              
                      var options = {                   
                        pieHole: 0.4,
                      };
              
                      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                      chart.draw(data, options);
                    }
                </script>
                <div id="donutchart"></div>
            </div>
            <div class="months">
                <label for="month">Select Month:</label>
                <select name="month" id="month">
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
                </select>
                <button type="submit">Filter</button>
                <p>Total Expenses: <?php echo $total_Eamount; ?></p>
                <p>Total Income: <?php echo $total_Iamount; ?></p>
                <p>Balance: <?php echo $total_Iamount - $total_Eamount; ?></p>
            </div>            
        </div>

        <!-- History -->
        <?php
            $sqlI = "SELECT * FROM income_table WHERE UserID = '$userID' ORDER BY IncomeID DESC LIMIT 5";
            $history_I = mysqli_query($conn,$sqlI);
            $sqlE = "SELECT * FROM expenses_table WHERE UserID = '$userID' ORDER BY ExpensesID DESC LIMIT 5 ";
            $history_E = mysqli_query($conn,$sqlE);
        ?>
        <br>
        <h3>History</h3>
        <br>
        <div id="money">      
            <table border = 1 class="income">
                <tr id="cum">
                    <th colspan="3">Income table</th>
                </tr>
                <tr>
                    <th>Date Time</th>
                    <th>Amount</th>
                    <th>Descrption</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($history_I)) { ?>
                <tr>
                        <td><?php echo $row["Datetime"]; ?></td>
                        <td><?php echo $row["Amount"]; ?></td>
                        <td><?php echo $row["Description"]; ?></td>
               </tr>
               <?php } ?>
            </table>
            <table border = 1 class="expense">
                <tr id="exp">
                    <th colspan="4">Expenses table</th>
                </tr>
                <tr>
                    <th>Expenses Type</th>
                    <th>Date Time</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($history_E)) { ?>
                <tr>
                        <td><?php echo $row["Expenses_Type"]; ?></td>
                        <td><?php echo $row["DateTime"]; ?></td>
                        <td><?php echo $row["Amount"]; ?></td>
                        <td><?php echo $row["Description"]; ?></td>
                </tr>
                <?php } ?>              
            </table>
        </div>
    </div> 
</body>
</html>
