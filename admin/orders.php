<?php
session_start();
include('../includes/header.php');
include('../includes/config.php');
//CREATE VIEW  salesPerOrder as SELECT o.orderinfo_id, SUM(i.sell_price * ol.quantity) FROM orderinfo o INNER JOIN orderline ol using (orderinfo_id) INNER JOIN item i USING (item_id)
// GROUP BY o.orderinfo_id;
// $sql = "SELECT o.orderinfo_id as orderId, SUM(i.sell_price * ol.quantity) as total FROM orderinfo o INNER JOIN orderline ol using (orderinfo_id) INNER JOIN item i USING (item_id)
// GROUP BY o.orderinfo_id";

//order details


$sql = "SELECT * FROM `salesperorder` ORDER BY total DESC";
$result = mysqli_query($conn, $sql);
$itemCount = mysqli_num_rows($result);

?>
<h2>number of items <?= $itemCount ?> </h2>
<table class="table table-striped table-bordered">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";

        echo "<td>{$row['orderinfo_id']}</td>";
        echo "<td>{$row['total']}</td>";
        echo "<td>{$row['status']}</td>";


        echo "<td><a href='orderDetails.php?id={$row['orderinfo_id']}'><i class='fa-regular fa-eye' style='color: blue'></i></a></td>";
        echo "</tr>";
    }
    ?>
</table>
<?php
include('../includes/footer.php');
?>