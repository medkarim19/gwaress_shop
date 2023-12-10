<section id="form">
    <style>
        #form {
            margin-top: 0;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .login-form {
            margin-bottom: 20px;
        }
    </style>
    <div class="container">
        <div class="row" style="margin: 0;">
            <div class="col-sm-4">
                <div class="login-form">
                    <h2 class="title text-center">Add Product </h2>

                    <form name="addProductForm" action="index.php?page=admin&action=addproduct" method="POST" enctype="multipart/form-data">
                        <input type="text" name="marque_id" placeholder="Marque ID" required />
                        <input type="text" name="nom" placeholder="Product Name" required />
                        <input type="text" name="prix" placeholder="Price" required />
                        <input type="text" name="quantite" placeholder="Quantite" required />
                        <input type="text" name="sexe_produit" placeholder="Product Sexe" required />
                        <div class="custom-file-upload">
                            <input type="file" name="image" id="file-upload" accept="image/*" required class="fas fa-cloud-upload-alt" />
                        </div>
                        <button type="submit" class="btn btn-default"> ADD </button>
                    </form>

                </div>
            </div>

            <div class="col-sm-4">
                <div class="login-form">
                    <h2 class="title text-center">Update Product </h2>
                    <form name="updateProductForm" action="index.php?page=admin&action=updateproduct" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id_produit" placeholder="Product ID" required />
                    <input type="text" name="marque_id" placeholder="Marque ID" />
                    <input type="text" name="nom" placeholder="Product Name" />
                    <input type="text" name="prix" placeholder="Price" />
                    <input type="text" name="quantite" placeholder="Quantite" required />
                    <input type="text" name="sexe_produit" placeholder="Product Sexe" />
                    <div class="custom-file-upload">
                        <input type="file" name="image" id="file-upload" accept="image/*" required class="fas fa-cloud-upload-alt" />
                    </div>
                    <button type="submit" class="btn btn-default"> UPDATE </button>
                    </form>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="login-form">
                    <h2 class="title text-center">Add Marque </h2>
                    <form name="addMarqueForm" action="index.php?page=addmarque" method="POST">
                        <input type="text" name="marque_id" placeholder="Marque ID" required />
                        <input type="text" name="marque_name" placeholder="Marque Name" required />
                        <button type="submit" class="btn btn-default"> ADD </button>
                    </form>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="login-form">
                    <h2 class="title text-center">Update Marque </h2>
                    <form name="updateMarqueForm" action="index.php?page=updatemarque" method="POST">
                        <input type="text" name="marque_id" placeholder="Marque ID" required />
                        <input type="text" name="new_marque_name" placeholder="New Marque Name" />
                        <button type="submit" class="btn btn-default"> UPDATE </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
