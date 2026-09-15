<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");

$status = trim($_POST['status']);



$sql = "UPDATE orderinfo SET status = '{$status}' WHERE orderinfo_id = {$_SESSION['orderId']}";

$result = mysqli_query($conn, $sql);
if ($result) {

    header("Location: ../index.php");
}