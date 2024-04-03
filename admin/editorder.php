<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>

<?php
if (isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id =? ");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $order = $stmt->get_result(); //[]

} else {
    header('location: index.php');
    exit;
}
?>


<!-- Sidebar  -->
<?php include ("sidemenu.php"); ?>

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Order Edit</h4>
                <h6>Update your order</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form id="edit-form" method="POST" action="editorder.php">
                        <?php foreach ($order as $r) { ?>
                            <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>" />
                            <!-- Name  -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Order Id: </label>
                                    <p>
                                        <?php echo $r['order_id']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Order Price: </label>
                                    <p>
                                        <?php echo $r['order_cost']; ?>
                                    </p>
                                </div>
                            </div>
                            <!-- Category -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Order Status: </label>
                                    <select class="select" name="status">
                                        <option>Not paid</option>
                                        <option>Paid</option>
                                        <option>Shipped</option>
                                        <option>Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Order Date: </label>
                                    <p>
                                        <?php echo $r['order_date']; ?>
                                    </p>
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
                                <button><a href="index.php" class="btn btn-cancel">Cancel</a></button>
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