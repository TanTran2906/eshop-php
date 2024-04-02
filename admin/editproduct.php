<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>

<?php
if ($_GET['product_id']) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products = $stmt->get_result();

} else {
    header('products.php');
    exit;
}
?>


<!-- Sidebar  -->
<?php include ("sidemenu.php"); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit</h4>
                <h6>Update your product</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form id="edit-form" method="POST" action="editproduct.php">
                        <?php foreach ($products as $product) { ?>

                            <!-- Name  -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" value="<?php echo $product['product_name']; ?>" name="title">
                                </div>
                            </div>
                            <!-- Category -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select">
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
                                    <input type="number" name="price" value="<?php echo $product['product_price']; ?>">
                                </div>
                            </div>
                            <!-- Color -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" name="color" value="<?php echo $product['product_color']; ?>">
                                </div>
                            </div>
                            <!-- Special offer/Sales -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Special offer/Sales</label>
                                    <input type="number" name="offer"
                                        value="<?php echo $product['product_special_offer']; ?>">
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control"
                                        name="description"><?php echo $product['product_description']; ?></textarea>
                                </div>
                            </div>

                            <!-- Image upload  -->
                            <!-- <div class="col-lg-12">
                            <div class="form-group">
                                <label> Product Image</label>
                                <div class="image-upload">
                                    <input type="file">
                                    <div class="image-uploads">
                                        <img src="assets/img/icons/upload.svg" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div> -->

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
                        <?php } ?>

                    </form>

                    <div class="col-lg-12">
                        <a href="javascript:void(0);" class="btn btn-submit me-2">Update</a>
                        <a href="productlist.html" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
</body>

</html>