<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>

<?php
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->get_result();//[]
?>

<!-- Sidebar  -->
<?php include ("sidemenu.php"); ?>

<!-- Content  -->
<div class="page-wrapper">
    <div class="content">

        <h2>Products</h2>
        <?php if (isset($_GET['product_created'])) { ?>
            <p class="text-center" style="color: green;">
                <?php echo $_GET['product_created']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['product_failed'])) { ?>
            <p class="text-center" style="color: red; ">
                <?php echo $_GET['product_failed']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['edit_success_message'])) { ?>
            <p class="text-center" style="color: green;">
                <?php echo $_GET['edit_success_message']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['edit_failure_message'])) { ?>
            <p class="text-center" style="color: red; ">
                <?php echo $_GET['edit_failure_message']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['deleted_successfully'])) { ?>
            <p class="text-center" style="color: green;">
                <?php echo $_GET['deleted_successfully']; ?>
            </p>
        <?php } ?>

        <?php if (isset($_GET['deleted_failure'])) { ?>
            <p class="text-center" style="color: red;">
                <?php echo $_GET['deleted_failure']; ?>
            </p>
        <?php } ?>

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Product id</th>
                        <th>Product image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Offer</th>
                        <th>Product Category</th>
                        <th>Product Color</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td>
                                <?php echo $product['product_id']; ?>
                            </td>
                            <td class="productimgname">
                                <a href="javascript:void(0);" class="product-img">
                                    <img src="<?php echo "../assets/img/" . $product['product_image']; ?>" alt="product">
                                </a>
                                <!-- <a href="javascript:void(0);">Macbook pro</a> -->
                            </td>

                            <td>
                                <?php echo $product['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $product['product_price']; ?>
                            </td>
                            <td>
                                <?php echo $product['product_special_offer']; ?>
                            </td>
                            <td>
                                <?php echo $product['product_category']; ?>
                            </td>
                            <td>
                                <?php echo $product['product_color']; ?>
                            </td>

                            <td>
                                <!-- <a class="me-3" href="product-details.html">
                                <img src="assets/img/icons/eye.svg" alt="img">
                            </a> -->
                                <a class="me-3" href="editproduct.php?product_id=<?php echo $product['product_id']; ?>">
                                    <img src="assets/img/icons/edit.svg" alt="img">
                                </a>
                                <a class="confirm-text"
                                    href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">
                                    <img src="assets/img/icons/delete.svg" alt="img">
                                </a>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>
            </table>
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