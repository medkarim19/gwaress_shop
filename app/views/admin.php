<section id="form">
    <style>
        #form {
            margin-top: 0;
            padding-top: 20px; /* Adjust as needed */
            padding-bottom: 20px; /* Adjust as needed */
        }

        .login-form {
            margin-bottom: 20px; /* Adjust as needed */
        }
    </style>
    <div class="container">
        <div class="row" style="margin: 0;">
            <!-- Add Product Form -->
            <div class="col-sm-3">
                <div class="login-form">
                    <h2>Add Product</h2>
                    <form name="addProductForm" action="addproduct.php" method="POST">
                        <input type="text" name="id_produit" placeholder="Product ID" required />
                        <input type="text" name="marque" placeholder="Marque" required />
                        <input type="text" name="nom" placeholder="Product Name" required />
                        <input type="text" name="prix" placeholder="Price" required />
                        <input type="text" name="sexe_produit" placeholder="Product Sexe" required />
                        <input type="text" name="qte_stock" placeholder="Stock Quantity" required />
                        <input type="text" name="path" placeholder="Image Path" required />
                        <button type="submit" class="btn btn-default"> ADD </button>
                    </form>
                </div>
            </div>

            <!-- Update Product Form -->
            <div class="col-sm-3">
                <div class="login-form">
                    <h2>Update Product</h2>
                    <form name="updateProductForm" action="updateproduct.php" method="POST">
                        <input type="text" name="id_produit" placeholder="Product ID" required />
                        <input type="text" name="marque" placeholder="Marque" />
                        <input type="text" name="name" placeholder="Product Name" />
                        <input type="text" name="prix" placeholder="Price" />
                        <input type="text" name="sexe_produit" placeholder="Product Sexe" />
                        <input type="text" name="qte_stock" placeholder="Stock Quantity" />
                        <button type="submit" class="btn btn-default"> UPDATE </button>
                    </form>
                </div>
            </div>

            <!-- Add Marque Form -->
            <div class="col-sm-3">
                <div class="login-form">
                    <h2>Add Marque</h2>
                    <form name="addMarqueForm" action="addmarque.php" method="POST">
                        <input type="text" name="marque_id" placeholder="Marque ID" required />
                        <input type="text" name="marque_name" placeholder="Marque Name" required />
                        <button type="submit" class="btn btn-default"> ADD </button>
                    </form>
                </div>
            </div>

            <!-- Update Marque Form -->
            <div class="col-sm-3">
                <div class="login-form">
                    <h2>Update Marque</h2>
                    <form name="updateMarqueForm" action="updatemarque.php" method="POST">
                        <input type="text" name="marque_id" placeholder="Marque ID" required />
                        <input type="text" name="new_marque_name" placeholder="New Marque Name" />
                        <button type="submit" class="btn btn-default"> UPDATE </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>