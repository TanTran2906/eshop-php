<?php

include ('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='DELL' LIMIT 4");

$stmt->execute();

$DELL_products = $stmt->get_result();//[]

?>