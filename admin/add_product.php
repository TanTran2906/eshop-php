<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>





<!-- Sidebar  -->
<?php include ("sidemenu.php"); ?>

<!-- Content  -->
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add Product </h4>
                <h6>Add your product</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form id="edit-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <input type="hidden" name="product_id" value="" />
                        <!-- Name  -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" value="" name="title" required>
                            </div>
                        </div>
                        <!-- Category -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category" required>
                                    <option>DELL</option>
                                    <option>ASUS</option>
                                    <option>HP</option>
                                    <option>ACER</option>
                                </select>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" value="" required>
                            </div>
                        </div>
                        <!-- Color -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" name="color" value="" required>
                            </div>
                        </div>
                        <!-- Special offer/Sales -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Special offer/Sales</label>
                                <input type="number" name="offer" value="" required>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Image 1: </label>
                                <input type="file" name="image1" value="" required>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Image 2: </label>
                                <input type="file" name="image2" value="">
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Image 3: </label>
                                <input type="file" name="image3" value="">
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Image 4: </label>
                                <input type="file" name="image4" value="">
                            </div>
                        </div>



                        <!-- <div class="col-12">
                            <div class="product-list">
                                <ul class="row">
                                    <li>
                                        <div class="productviews">
                                            <div class="productviewsimg">
                                                <img src="assets/img/icons/macbook.svg" alt="img">
                                            </div>
                                            <div class="productviewscontent">
                                                <div class="productviewsname">
                                                    <h2>macbookpro.jpg</h2>
                                                    <h3>581kb</h3>
                                                </div>
                                                <a href="javascript:void(0);" class="hideset">x</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                        <div class="col-lg-12">
                            <button type="submit" name="create_product"><a class="btn btn-submit me-2">Add
                                    product</a></button>
                            <button><a href="products.php" class="btn btn-cancel">Cancel</a></button>
                        </div>

                    </form>


                </div>
            </div>
        </div>

    </div>
</div>
</div>

<!-- Script -->
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>
</body>

</html>