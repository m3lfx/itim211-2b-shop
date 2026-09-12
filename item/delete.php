<?php
session_start();
include('../includes/config.php');
// $id = $_GET['id']
$item_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$item_id) {
    header('Location: /itim211-2b-shop/item/index.php');
    exit;
}

mysqli_begin_transaction($conn);

try {
    $stockStmt = mysqli_prepare($conn, 'DELETE FROM stock WHERE item_id = ?');
    mysqli_stmt_bind_param($stockStmt, 'i', $item_id);
    mysqli_stmt_execute($stockStmt);

    $itemStmt = mysqli_prepare($conn, 'DELETE FROM item WHERE item_id = ?');
    mysqli_stmt_bind_param($itemStmt, 'i', $item_id);
    mysqli_stmt_execute($itemStmt);

    mysqli_commit($conn);
} catch (Throwable $error) {
    mysqli_rollback($conn);
    die($error->getMessage());
}

header('Location: /itim211-2b-shop/item/index.php');
exit;