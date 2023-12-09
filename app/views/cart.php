<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();
?>
<section id="cart_items">
    <div class="container">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkoutButton'])) {
    echo '<div id="alertMsg" class="alert alert-primary" role="alert">
        Your command will be validated soon. Please check your email!
    </div>
    <script>
        setTimeout(function() {
            document.getElementById("alertMsg").style.display = "none";
        }, 5000);
    </script>';
} ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description">Marque</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="action">Action</td> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['cartItems'])) : ?>
                        <?php foreach ($data['cartItems'] as $row1) : ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="assets\images\shop\<?= isset($row1['path']) ? $row1['path'] : ''; ?>" width="200" height="200" /></a>
                                </td>
    
                                <td class="cart_description">
                                    <p><?= isset($row1['marque']) ? $row1['marque'] : ''; ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <?= isset($row1['prix']) ? $row1['prix'] . ' T.N.D' : ''; ?>
                                </td>
                                <td class="cart_quantity" >
                                <form class="update-quantity-form" action="index.php?page=cart" method="POST">
                                    <input type="number" name="quantity" class="quantity-input" value="<?= isset($row1['quantite']) ? $row1['quantite'] : 1; ?>" min="1" style="width: 40px;">
                                    <button type="submit" class="submit-button" style="background-color: green; color: white; border: none;">
                                        &#10004;
                                    </button>
                                    <input type="hidden" name="action" value="updateCartItemQuantity">
                                    <input type="hidden" name="cartItemId" value="<?= $row1['id']; ?>">
                                    <input type="hidden" name="userId" value="<?= $_SESSION['user_id']; ?>">
                                    <input type="hidden" name="productId" value="<?= $row1['produit_id']; ?>">
                                </form>
                                </td>
                                
                                <td class="cart_delete">
                                    <form action="index.php?page=cart" method="POST">
                                        <input type="hidden" name="action" value="removeFromCart">
                                        <input type="hidden" name="deleteItemId" value="<?= $row1["id"]; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" style="background-color: #FE980F;">
                                            <i class="fa fa-times"></i> Undo
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; background-color: #f8f8f8;">
                                <p style="font-size: 28px; color: gray; margin-bottom: 10px;">Your Cart is currently Empty</p>
                                <a href="index.php?page=home" class="nav-link" style="color: gray; font-size: 21px; text-decoration: none;">Click to Continue Shopping</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tr class="cart_menu">
                    <td colspan="4" align="right">Total =</td>
                    <td align="left"> T.N.D </td>
                </tr>
            </table>
        </div>
        <?php if (!empty($data['cartItems'])) : ?>
            <form class="checkout-form" action="index.php?page=cart" method="POST">
            <button class="btn btn-default check_out" name="checkoutButton">
                    Check Out
            </button>
            </form>
        <?php else : ?>
            <button class="btn btn-default check_out" disabled>
                Check Out
            </button>
            <?php endif; ?>
    </div>
</section>
<?php ob_end_flush(); ?>
