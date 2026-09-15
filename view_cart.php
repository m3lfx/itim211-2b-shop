<?php
session_start();
include('includes/header.php');
include('includes/config.php');
?>

<h1 align="center">View Cart</h1>
<div class="cart-view-table-back">
    <form method="POST" action="cart_update.php">
        <table width="100%" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["cart_products"])) //check session var
                {

                    $total = 0; //set initial total value
                    $b = 0; //var for zebra stripe table 

                    foreach ($_SESSION["cart_products"] as $cart_itm) {

                        //set variables to use in content below

                        $product_name = $cart_itm["item_name"];

                        $product_qty = $cart_itm["item_qty"];

                        $product_price = $cart_itm["item_price"];

                        $product_code = $cart_itm["item_id"];
                        $subtotal = ($product_price * $product_qty); //calculate Price x Qty

                        $bg_color = ($b++ % 2 == 1) ? 'odd' : 'even'; //class for zebra stripe 

                        echo '<tr class="' . $bg_color . '">';

                        echo '<td><input type="text" size="2" maxlength="2" name="product_qty[' . $product_code . ']" value="' . $product_qty . '" /></td>';

                        echo '<td>' . $product_name . '</td>';

                        echo '<td>' . $product_price . '</td>';

                        echo '<td>' . $subtotal . '</td>';

                        echo '<td><input type="checkbox" name="remove_code[]" value="' . $product_code . '" /></td>';

                        echo '</tr>';

                        $total = ($total + $subtotal); //add subtotal to total var

                    }
                }

                ?>

                <tr>
                    <td colspan="5"><span style="float:right;text-align: right;">Amount Payable : <?php echo sprintf("%01.2f", $total); ?></span></td>
                </tr>

                <tr>
                    <td colspan="5"><a href="index.php" class="button">Add More Items</a>

                        <button type="submit">Update</button>
                    <td colspan="5"><a href="checkout.php" class="button">checkout</a></td>
                </tr>

            </tbody>

        </table>

      

    </form>

</div>
<?php
include('./includes/footer.php');
?>