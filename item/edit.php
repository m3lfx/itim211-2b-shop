<?php
session_start();
include('../includes/adminHeader.php');
include('../includes/config.php');

// var_dump($_SESSION);
// unset($_SESSION);
$item_id = (int)$_GET['id'];
$sql = "SELECT i.*, s.quantity FROM item i INNER JOIN stock s ON i.item_id = s.item_id WHERE i.item_id = $item_id";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($result);
// var_dump($item);
?>

<body>

    <div class="container">
        <?php include('../includes/alert.php'); ?>
        <form method="POST" action="<?php echo "update.php/{$item['item_id']}" ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter item name" name="description"
                    value="<?php

                            if (isset($_SESSION['desc']))
                                echo $_SESSION['desc'];
                            else
                                echo $item['description'];
                            ?>" />

                <small><?php
                        if (isset($_SESSION['descError'])) {
                            echo $_SESSION['descError'];
                            unset($_SESSION['descError']);
                        }
                        ?></small>


                <label for="cost">Cost Price</label>

                <input type="text" class="form-control" id="cost" placeholder="Enter item cost price" name="cost_price"
                    value="<?php

                            if (isset($_SESSION['cost']))
                                echo $_SESSION['cost'];
                            else
                                echo $item['cost_price'];
                            ?>" />
                <small><?php
                        if (isset($_SESSION['costError'])) {
                            echo $_SESSION['costError'];
                            unset($_SESSION['costError']);
                        }
                        ?></small>
                <label for="sell">sell price</label>

                <input type="text" class="form-control" id="sell" placeholder="Enter sell price" name="sell_price"
                    value="<?php

                            if (isset($_SESSION['sell']))
                                echo $_SESSION['sell'];
                            else
                                echo $item['sell_price'];
                            ?>">
                <small><?php
                        if (isset($_SESSION['sellError'])) {
                            echo $_SESSION['sellError'];
                            unset($_SESSION['sellError']);
                        }
                        ?></small>

                <label for="qty">quantity</label>

                <input type="number" class="form-control" id="qty" placeholder="1" name="quantity" value="<?php
                                                                                                            if (isset($_SESSION['qty']))
                                                                                                                echo $_SESSION['qty'];
                                                                                                            else
                                                                                                                echo $item['quantity'];
                                                                                                            ?>" />
                <small><?php
                        if (isset($_SESSION['qtyError'])) {
                            echo $_SESSION['qtyError'];
                            unset($_SESSION['qtyError']);
                        }
                        ?></small>
                <input class="form-control" type="file" name="img_path" /><br />
                <small><?php
                        if (isset($_SESSION['imageError'])) {
                            echo $_SESSION['imageError'];
                            unset($_SESSION['imageError']);
                        }
                        ?></small>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="index.php" role="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php
    include('../includes/footer.php');
    ?>