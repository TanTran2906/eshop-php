<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id= ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products = $stmt->get_result();

} else if (isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $offer = $_POST['offer'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE products SET product_name = ? ,product_description= ? , product_price = ? ,product_special_offer = ? ,
    product_color = ? ,product_category = ?  WHERE product_id = ? ");

    $stmt->bind_param('ssssssi', $title, $description, $price, $offer, $color, $category, $product_id);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Product has been updated successfully!');
    } else {
        header('location: products.php?edit_failure_message=Error occured, try again!');
    }

} else {
    header('location: products.php');
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
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" required />
                            <!-- Name  -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" value="<?php echo $product['product_name']; ?>" name="title"
                                        required>
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
                                    <input type="text" name="price" value="<?php echo $product['product_price']; ?>"
                                        required>
                                </div>
                            </div>
                            <!-- Color -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" name="color" value="<?php echo $product['product_color']; ?>"
                                        required>
                                </div>
                            </div>
                            <!-- Special offer/Sales -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Special offer/Sales</label>
                                    <input type="number" name="offer"
                                        value="<?php echo $product['product_special_offer']; ?>" required>
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" required
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
                            <div class="col-lg-12">

                                <button type="submit" name="edit_btn"><a class="btn btn-submit me-2">Update</a></button>
                                <button><a href="productlist.php" class="btn btn-cancel">Cancel</a></button>
                            </div>
                        <?php } ?>

                    </form>


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