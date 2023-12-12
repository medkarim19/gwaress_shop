<section>
    <div class="container" id="productContainerWomen">
        <div class="row col-md-0.7" >
            <?php
            $counter = 0;
            $products = $data['products'];

            if (empty($products)) {
                echo '<p>No products found.</p>';
            } else {
                foreach ($products as $product) :
                    $counter++;
            ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper text-center" style="border: none;">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="assets/images/shop/<?php echo $product['path']; ?>" width="100" height="200" />
                                    <p><?php echo $product['prix']; ?> T.N.D</p>
                                    <p><?php echo $product['nom']; ?></p>
                                    <p>Marque: <?php echo $product['nom_marque']; ?></p>
                                    <form action="index.php?page=cart&action=addToCart" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id_produit']; ?>">
                                        <button type="submit" class="btn btn-default add-to-cart" name="submit">
                                            Add to cart
                                        </button>
                                    </form>
                                    <?php if (isset($_SESSION['user_name']) && $_SESSION['user_name'] === 'admin') : ?>
                                        <form action="index.php?page=womenshop&action=deleteProductForWomen" method="POST" class="delete-product-form">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id_produit']; ?>">
                                            <button type="submit" class="btn btn-danger delete-product" name="submit" value="DeleteProduct">
                                                Delete
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                    if ($counter % 3 == 0) {
                        echo '</div><div class="row">';
                    }
                endforeach;
            }
            ?>
        </div>
    </div>
</section>

<style>
    .add-to-cart-form,
    .delete-product-form {
        margin-top: 10px;
    }
</style>


