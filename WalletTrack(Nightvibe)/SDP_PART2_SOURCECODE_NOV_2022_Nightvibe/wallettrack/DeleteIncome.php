<?php
include 'DBConnection.php';
$id = $_GET['id'];
    $query = "DELETE FROM `income_table` WHERE IncomeID='$id'";
    if (mysqli_query($conn, $query)){
        echo 'information has been deleted';
        header('Location: IncomeRecordPage.php');
    }else{
        echo 'Sorry record was not deleted';
    }
?> 