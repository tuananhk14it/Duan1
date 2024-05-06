<?php
include_once('connect.php');
//include_once('../lib/msgProduct.php');

//lấy prd_id từ form            
    $prd_id = $_GET["prd_id"];

    //lấy link ảnh để xóa ảnh trong thư mục trước khi xóa sản phẩm
    //nếu xóa sản phẩm trước sẽ mất id_image, không xóa được ảnh
    $sql_img = "SELECT prd_image FROM product
                WHERE prd_id=" . $prd_id;
    $query_del = mysqli_query($conn, $sql_img);
    $row = mysqli_fetch_array($query_del);

    $url_img = "img/products/" . $row["prd_image"];
    $status = unlink($url_img); //xóa file ảnh trong thư mục

    //xóa comment
    $sql_comm = "DELETE FROM comment
                WHERE prd_id = $prd_id";
    $query = mysqli_query($conn, $sql_comm);

    //sau khi xóa comment và xóa ảnh thì ta mới xóa sản phẩm
    $sql = "DELETE FROM product WHERE prd_id=" . $prd_id;
    $query = mysqli_query($conn, $sql); //xóa sản phẩm
    echo '<script> msgDelComplete("Sản phẩm")</script>';
    header("location: index.php?page_layout=product");
