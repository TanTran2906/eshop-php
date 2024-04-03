<?php include ("header.php"); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit();
}
?>

<?php
$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->get_result();//[]
?>

<!-- Sidebar  -->
<?php include ("sidemenu.php"); ?>

<!-- Content  -->
<div class="page-wrapper">
    <div class="content">

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Order Status</th>
                        <th>User Id</th>
                        <th>Order Date</th>
                        <th>User Phone</th>
                        <th>User Address</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td>
                                <?php echo $order['order_id']; ?>
                            </td>
                            <td>
                                <?php echo $order['order_status']; ?>
                            </td>
                            <td>
                                <?php echo $order['user_id']; ?>
                            </td>
                            <td>
                                <?php echo $order['order_date']; ?>
                            </td>
                            <td>
                                <?php echo $order['user_phone']; ?>
                            </td>
                            <td>
                                <?php echo $order['user_address']; ?>
                            </td>

                            <td>
                                <!-- <a class="me-3" href="product-details.html">
                                <img src="assets/img/icons/eye.svg" alt="img">
                            </a> -->
                                <a class="me-3" href="editorder.php?order_id=<?php echo $order['order_id']; ?>">
                                    <img src="assets/img/icons/edit.svg" alt="img">
                                </a>
                                <a class="confirm-text" href="javascript:void(0);">
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