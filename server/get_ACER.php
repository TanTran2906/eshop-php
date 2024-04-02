<?php

include ('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='ACER' LIMIT 4");

$stmt->execute();

$ACER_products = $stmt->get_result();//[]

?>