<?php
session_start();
include('../includes/header.php');
include('../includes/config.php');
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$item_id = (int)basename($path);
// var_dump($last_segment);

$cost =  (float)$_POST['cost_price'];
$sell = (float)$_POST['sell_price'];
$desc = trim($_POST['description']);
$qty = (int)$_POST['quantity'];

if (empty($_POST['description'])) {
    $_SESSION['descError'] = 'Please input a Product description';

    header("Location: edit.php");
}
if (empty($_POST['cost_price']) || (! is_numeric($_POST['cost_price']))) {
    $_SESSION['costError'] = 'error product price format';
    header("Location: edit.php");
}

if (empty($_POST['img_path'])) {
    $_SESSION['imageError'] = 'Please select an image';

    header("Location: edit.php");
}

if (isset($_POST['submit'])) {

    $_SESSION['cost'] = $_POST['cost_price'];
    $_SESSION['sell'] = $_POST['sell_price'];
    $_SESSION['desc'] = $_POST['description'];
    $_SESSION['qty'] = $_POST['quantity'];

    if (isset($_FILES['img_path'])) {
        if ($_FILES['img_path']['type'] == "image/jpeg" || $_FILES['img_path']['type'] == "image/jpg" || $_FILES['img_path']['type'] == "image/png") {
            $source = $_FILES['img_path']['tmp_name'];
            $target = 'images/' . $_FILES['img_path']['name'];
            move_uploaded_file($source, $target) or die("Couldn't copy");
        } else {
            $_SESSION['imageError'] = "wrong file type";
            header("Location: update.php");
        }
    }

    $sql = "UPDATE item SET description='{$desc}', cost_price={$cost}, sell_price={$sell}, img_path='{$target}' WHERE item_id = {$item_id}";

    $result = mysqli_query($conn, $sql);

    $q_stock = "UPDATE stock SET quantity= {$qty} WHERE item_id = {$item_id} ";
    $result2 = mysqli_query($conn, $q_stock);
    $_SESSION = array();
    header("Location: index.php");
}
