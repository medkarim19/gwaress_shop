<section>
    <div class="container">
        <div class="row col-md-0.7">
            <?php
            $counter = 0;
            foreach ($data['products'] as $product) :
                $counter++;
            ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper text-center" style="border: none;">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="assets/images/shop/<?php echo $product['path']; ?>" width="100" height="200" />
                                <p><?php echo $product['prix']; ?> T.N.D</p>
                                <p><?php echo $product['nom']; ?></p>
                                <p>Marque: <?php echo $product['marque']; ?></p>
                                <form action="index.php?page=cart&action=addToCart" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id_produit']; ?>">
                                    <button type="submit" class="btn btn-default add-to-cart" name="submit" value="AddToCart">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($counter % 3 == 0) {
                    echo '</div><div class="row">';
                }
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>