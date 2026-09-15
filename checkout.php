<?php
session_start();
include('includes/header.php');
include('includes/config.php');
// print_r($_SESSION);
try {
    // $sql = "SELECT customer_id FROM customer WHERE user_id = {$_SESSION['user_id']} LIMIT 1";

    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    mysqli_begin_transaction($conn);
    // mysqli_query($conn, 'START TRANSACTION');
    // $customer_id = $row['customer_id'];
    $customer_id = 1;
    $q = 'INSERT INTO orderinfo(customer_id, date_placed, date_shipped,shipping) VALUES (?, NOW(), NOW(), ?)';
    $shipping = 10.00;
    // $shipvia = 1;

    $stmt1 = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($stmt1, 'id', $customer_id, $shipping);
    mysqli_stmt_execute($stmt1);
    $orderinfo_id = mysqli_insert_id($conn);
    echo $orderinfo_id;

    $q2 = 'INSERT INTO orderline(orderinfo_id ,item_id,quantity)VALUES (?, ?, ?)';
    $stmt2 = mysqli_prepare($conn, $q2);
    mysqli_stmt_bind_param($stmt2, 'iii', $orderinfo_id, $product_code, $product_qty);

    $q3 = 'UPDATE stock SET quantity = quantity - ? WHERE item_id = ?';

    $stmt3 = mysqli_prepare($conn, $q3);
    mysqli_stmt_bind_param($stmt3, 'ii', $product_qty, $product_code);

    foreach ($_SESSION["cart_products"] as $cart_itm) {
        //set variables to use in content below
        $product_qty = $cart_itm["item_qty"];
        $product_code = $cart_itm["item_id"];
        //print_r($product_code);

        mysqli_stmt_execute($stmt2);
        mysqli_stmt_execute($stmt3);
    }

    mysqli_commit($conn);
    unset($_SESSION['cart_products']);
} catch (mysqli_sql_exception $e) {
    echo $e->getMessage();
    mysqli_rollback($conn);
}
