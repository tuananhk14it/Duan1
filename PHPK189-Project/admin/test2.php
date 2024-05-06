<?php
if (!defined("TEMPLATE")) {
    die("Bạn không có quyền truy cập vao file này!");
}
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php 
    function thongbao()
    {
?>  

        <div class="bs-example">
            <div id="myModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>   
                            <h4 class="modal-title">Thông báo</h4>
                                            
                        </div>
                        <div class="modal-body">
                            <p>Bạn có muốn xóa thông tin này không?</p> 
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Có</button>
                            <button type="button" class="btn btn-primary">Không</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php

    }
  

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_product" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Tên sản phẩm</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET["page"])) {
                                $page = $_GET["page"];
                            } else {
                                $page = 1;
                            }
                            $rows_per_page = 4;
                            $per_row = $page * $rows_per_page - $rows_per_page;
                            $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product"));
                            $total_pages = ceil($total_rows / $rows_per_page);
                            $list_pages = '<ul class="pagination">';

                            // Page Prev
                            $page_prev = $page - 1;
                            if ($page_prev == 0) {
                                $page_prev = 1;
                            }
                            $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $page_prev . '">&laquo;</a></li>';

                            for ($i = 1; $i <= $total_pages; $i++) {
                                $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                            }
                            // Page Next
                            $page_next = $page + 1;
                            if ($page_next > $total_pages) {
                                $page_next = $total_pages;
                            }
                            $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $page_next . '">&raquo;</a></li>';
                            $list_pages .= '</ul>';
                            echo $list_pages;

                            $sql = "SELECT * FROM product
                                    INNER JOIN category
                                    ON product.cat_id = category.cat_id
                                    ORDER BY prd_id DESC
                                    LIMIT $per_row, $rows_per_page ";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td style=""><?php echo $row["prd_id"]; ?></td>
                                    <td style=""><?php echo $row["prd_name"]; ?></td>
                                    <td style=""><?php echo $row["prd_price"]; ?> vnd</td>
                                    <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row["prd_image"]; ?>" /></td>
                                    <td><span class="label label-<?php 
                                                                    if ($row["prd_status"] == 1) 
                                                                    {
                                                                        echo "success";
                                                                    } 
                                                                    else 
                                                                    {
                                                                        echo "danger";
                                                                    } 
                                                                    ?>">
                                                                    <?php 
                                                                    if ($row["prd_status"] == 1)
                                                                     {
                                                                                echo "Còn Hàng";
                                                                     } 
                                                                     else 
                                                                     {
                                                                                echo "Hết Hàng";
                                                                            
                                                                     } ?>
                                            </span>
                                    </td>
                                    <td><?php echo $row["cat_name"] ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row["prd_id"]; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="del_product.php?prd_id=<?php echo $row["prd_id"]; ?>" class="btn btn-danger" onclick = "return confirmDel()"><i class="glyphicon glyphicon-remove"></i></a>
                                      
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <?php echo $list_pages ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>


