<?php
// CREATE VIEW orderdetails AS select `c`.`fname` AS `fname`,`c`.`lname` AS `lname`,`c`.`addressline` AS `addressline`,`c`.`town` AS `town`,`c`.`phone` AS `phone`,`c`.`zipcode` AS `zipcode`,`oi`.`orderinfo_id` AS `orderinfo_id`,`oi`.`date_placed` AS `date_placed`,`oi`.`status` AS `status`,`i`.`description` AS `description`,`ol`.`quantity` AS `quantity`,`i`.`sell_price` AS `sell_price` from (((`db_sample_2024`.`customer` `c` join `db_sample_2024`.`orderinfo` `oi` on(`c`.`customer_id` = `oi`.`customer_id`)) join `db_sample_2024`.`orderline` `ol` on(`oi`.`orderinfo_id` = `ol`.`orderinfo_id`)) join `db_sample_2024`.`item` `i` on(`ol`.`item_id` = `i`.`item_id`))

session_start();
include('../includes/header.php');
include('../includes/config.php');

$orderId = $_GET['id'];
$_SESSION['orderId'] = $orderId;

$sql = "SELECT lname, fname, addressline, town, zipcode, phone, orderinfo_id, status FROM `orderdetails` WHERE orderinfo_id = $orderId LIMIT 1";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);
echo $sql;
$sql = "SELECT description, quantity, sell_price  FROM `orderdetails` WHERE orderinfo_id = $orderId ";
$items = mysqli_query($conn, $sql);

?>
<h2><?= $customer['orderinfo_id'] ?> </h2>
<h3><?php echo "{$customer['lname']} {$customer['fname']}" ?></h3>
<p><?php echo "{$customer['addressline']} {$customer['town']} {$customer['zipcode']} {$customer['phone']}" ?></p>
<table class="table table-striped table-bordered">
    <thead>
        <th>item name</th>
        <th>quantity</th>
        <th>price</th>
        <th>total</th>
    </thead>

    <?php
    $grandTotal = 0;
    while ($row = mysqli_fetch_assoc($items)) {
        $total = $row['sell_price'] * $row['quantity'];
        $grandTotal += $total;
        echo "<tr>";

        echo "<td>{$row['description']}</td>";
        echo "<td>{$row['quantity']} </td>";
        echo "<td>{$row['sell_price']}</td>";

        echo "<td>{$total}</td>";



        echo "</tr>";
    }
    ?>
</table>
<h4><?= $grandTotal ?></h4>
<form action="updateOrder.php" method="POST">
    <select class="form-select" aria-label="Default select example" name="status">
        <option selected>Open this select menu</option>
        <option value="Processing">processing</option>
        <option value="Delivered">delivered</option>
        <option value="Canceled">canceled</option>
    </select>
    <button type="submit" class="btn btn-primary">update order</button>
</form>

<?php

include('../includes/footer.php');
?>