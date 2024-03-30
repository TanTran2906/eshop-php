<?php

include('connection.php');
// Câu lệnh SQL để lấy thông tin từ bảng products với điều kiện giới hạn (LIMIT) là 4 dòng. $conn đại diện cho kết nối đến cơ sở dữ liệu từ include('connection.php');. 
$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");
// Thực thi câu lệnh SQL thực hiện truy vấn đến cơ sở dữ liệu.
$stmt->execute();
// Lấy kết quả của truy vấn đã được thực thi, sử dụng để lặp qua và hiển thị dữ liệu trong bảng products.
$featured_products = $stmt->get_result();//[]

?>