<?php
include 'DBConnection.php';
$id = $_GET['id'];
    $query = "DELETE FROM `expenses_table` WHERE ExpensesID='$id'";
    if (mysqli_query($conn, $query)){
        echo 'information has been deleted';
        header('Location: ExpensesRecordPage.php');
    }else{
        echo 'Sorry record was not deleted';
    }
?> 