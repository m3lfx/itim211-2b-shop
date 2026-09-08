<?php
session_start();
include('../includes/header.php');
include('../includes/config.php');

// var_dump($_SESSION);
// unset($_SESSION);

?>

<body>
    <div class="container">
        <?php include('../includes/alert.php'); ?>
        <form method="POST" action="store.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter item name" name="description"
                    value="<?php

                            if (isset($_SESSION['desc']))
                                echo $_SESSION['desc'];
                            ?>" />

                <small><?php
                        if (isset($_SESSION['descError'])) {
                            echo $_SESSION['descError'];
                            unset($_SESSION['descError']);
                        }
                        ?></small>


                <label for="cost">Cost Price</label>

                <input type="text" class="form-control" id="cost" placeholder="Enter item cost price" name="cost_price"
                    value="<?php if (isset($_SESSION['cost']))
                                echo $_SESSION['cost']; ?>">
                <small><?php
                        if (isset($_SESSION['costError'])) {
                            echo $_SESSION['costError'];
                            unset($_SESSION['costError']);
                        }
                        ?></small>
                <label for="sell">sell price</label>

                <input type="text" class="form-control" id="sell" placeholder="Enter sell price" name="sell_price"
                    value="<?php echo $_SESSION['sell']; ?>">

                <label for="qty">quantity</label>

                <input type="number" class="form-control" id="qty" placeholder="1" name="quantity"
                    value="<?php echo $_SESSION['qty']; ?>" />
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