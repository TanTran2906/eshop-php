<?php

include ('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='HP' LIMIT 4");

$stmt->execute();

$HP_products = $stmt->get_result();//[]

?>