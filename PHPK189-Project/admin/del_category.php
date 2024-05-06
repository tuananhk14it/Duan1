<?php
include_once("../lib/msgProduct.php");
include_once('connect.php');
$cat_id = $_GET["cat_id"];
$sql_check = "SELECT * FROM product 
              INNER JOIN category ON category.cat_id = product.cat_id
              WHERE product.cat_id=".$cat_id;

 $query_check= mysqli_query($conn,$sql_check);
 $row_data = mysqli_fetch_array($query_check);
 $row_check = mysqli_num_rows($query_check);
 
 if ($row_check>0)
 {
 ?>
     <script> msgDelError("Danh mục ","Product");</script>
 <?php     

}
else
{
    $sql_del = "DELETE FROM Category WHERE cat_id=".$cat_id;
    $query= mysqli_query($conn,$sql_del);
    $row = mysqli_fetch_array($query);
    mysqli_query($conn, $sql_del);
    echo '<script> msgDelComplete("Danh mục")</script>';    
}
   ?>