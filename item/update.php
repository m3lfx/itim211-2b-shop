<?php
session_start();
include('../includes/config.php');
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$item_id = (int)basename($path);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $desc = trim($_POST['description'] ?? '');
    $costInput = trim($_POST['cost_price'] ?? '');
    $sellInput = trim($_POST['sell_price'] ?? '');
    $qtyInput = trim($_POST['quantity'] ?? '');
    $hasErrors = false;

    if ($desc === '') {
        $_SESSION['descError'] = 'Please input a Product description';
        $hasErrors = true;
    }
    if ($costInput === '' || !is_numeric($costInput)) {
        $_SESSION['costError'] = 'Please enter a valid cost price';
        $hasErrors = true;
    }
    if ($sellInput === '' || !is_numeric($sellInput)) {
        $_SESSION['sellError'] = 'Please enter a valid sell price';
        $hasErrors = true;
    }
    if ($qtyInput === '' || filter_var($qtyInput, FILTER_VALIDATE_INT) === false || (int)$qtyInput < 0) {
        $_SESSION['qtyError'] = 'Please enter a valid quantity';
        $hasErrors = true;
    }

    if ($hasErrors) {
        $_SESSION['cost'] = $costInput;
        $_SESSION['sell'] = $sellInput;
        $_SESSION['desc'] = $desc;
        $_SESSION['qty'] = $qtyInput;
        header("Location: edit.php?id={$item_id}");
        exit;
    }

    $cost = (float)$costInput;
    $sell = (float)$sellInput;
    $qty = (int)$qtyInput;

    $target = '';
    if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['img_path']['type'] == "image/jpeg" || $_FILES['img_path']['type'] == "image/jpg" || $_FILES['img_path']['type'] == "image/png") {
            $source = $_FILES['img_path']['tmp_name'];
            $target = 'images/' . $_FILES['img_path']['name'];
            move_uploaded_file($source, $target) or die("Couldn't copy");
        } else {
            $_SESSION['imageError'] = "wrong file type";
            header("Location: edit.php?id={$item_id}");
            exit;
        }
    } else {
        $target = 'images/default.jpg';
    }

    $desc = mysqli_real_escape_string($conn, $desc);

    if ($target !== '') {
        $target = mysqli_real_escape_string($conn, $target);
    }
    $sql = "UPDATE item SET description='{$desc}', cost_price={$cost}, sell_price={$sell}, img_path='{$target}' WHERE item_id = {$item_id}";

    $result = mysqli_query($conn, $sql);

    $q_stock = "UPDATE stock SET quantity= {$qty} WHERE item_id = {$item_id}";
    $result2 = mysqli_query($conn, $q_stock);
    if (!$result || !$result2) {
        die(mysqli_error($conn));
    }

    if ($result && $result2) {
        $_SESSION = array();
        header("Location: /itim211-2b-shop/item/index.php");
        exit;
    }
}
