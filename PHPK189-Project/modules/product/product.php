<?php
$prd_id = $_GET["prd_id"];
$sql = "SELECT * FROM product
        WHERE prd_id = $prd_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>
<!--	List Product	-->
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $row["prd_image"] ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row["prd_name"] ?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?php echo $row["prd_warranty"] ?></li>
                <li><span>Đi kèm:</span> <?php echo $row["prd_accessories"] ?></li>
                <li><span>Tình trạng:</span> <?php echo $row["prd_new"] ?></li>
                <li><span>Khuyến Mại:</span> <?php echo $row["prd_promotion"] ?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo formatPrice($row["prd_price"]) ?></li>
                <li id="status" <?php if ($row["prd_status"] == 0) { ?> class="text-danger" <?php } ?>><?php if ($row["prd_status"] == 1) {
                                                                                                            echo "Còn hàng";
                                                                                                        } else {
                                                                                                            echo "Hết hàng";
                                                                                                        } ?></li>
            </ul>
            <div id="add-cart"><a href="modules/cart/cart_add.php?prd_id=<?php echo $row["prd_id"] ?>">Mua ngay</a></div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row["prd_name"] ?></h3>
            <?php echo $row["prd_details"] ?>
        </div>
    </div>

    <!--	Comment	-->
    <?php
    if (isset($_POST['sbm'])) {
        $comm_name = $_POST['comm_name'];
        $comm_mail = $_POST['comm_mail'];
        $comm_details = $_POST['comm_details'];
        date_default_timezone_set('Asia/Bangkok');
        $comm_date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO comment (prd_id, comm_name, comm_mail, comm_date, comm_details) 
                VALUES ('$prd_id', '$comm_name', '$comm_mail', '$comm_date', '$comm_details')";
        $captcha = $_POST['captcha'];//lấy mã người dùng nhập vào
        $digit = $_SESSION['digit'];//lấy mã code đang hiển thị
        if($captcha == $digit){//kiểm tra nếu người dùng nhập đúng thì cho đăng bình luận - ngược lại báo lỗi
            $query = mysqli_query($conn, $sql);
        }
        else{
            $error = '<div class="alert alert-danger"> Mã captcha sai, nhập lại để bình luận!</div>';
        }
    }
    ?>

    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post" action="index.php?page_layout=product&prd_id=<?php echo $prd_id ?>">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <div>
                <!-- tạo khung chứa mã captcha -->
                    <?php if(isset($error)) {echo $error;} ?>
                    <p><img src="modules/captcha/captcha.php" width="120" height="30" alt=""></p>
                    <p><input type="text" size="6" maxlength="5" name="captcha" required value=""><br>
                    <small>nhập mã captcha để đăng bình luận</small></p>
                <!-- tạo khung chứa mã captcha -->  
                    <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
                </div>
                
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->

    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $row_per_page = 3;
            $per_row = $page * $row_per_page - $row_per_page;

            $sql_comm = "SELECT * FROM comment
                                    WHERE prd_id = $prd_id
                                    ORDER BY comm_id DESC
                                    LIMIT $per_row, $row_per_page";

            $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment WHERE prd_id = $prd_id"));
            $total_pages = ceil($total_rows / $row_per_page);

            $list_page = '<ul class="pagination">';

            $page_prev = $page - 1;
            if ($page_prev == 0) {
                $page_prev = 1;
            }
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $page_prev . '">Trang trước</a></li>';

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($page == $i) {
                    $list_page .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $i . '">' . $i . '</a></li>';
                } else {
                    $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $i . '">' . $i . '</a></li>';
                }
            }

            $page_next = $page + 1;
            if ($page_next > $total_pages) {
                $page_next = $total_pages;
            }
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $page_next . '">Trang sau</a></li>';

            $list_page .= '</ul>';

            $query_comm = mysqli_query($conn, $sql_comm);
            while ($row = mysqli_fetch_array($query_comm)) {
            ?>
                <div class="comment-item">
                    <ul>
                        <li><b><?php echo $row["comm_name"] ?></b></li>
                        <li><?php echo $row["comm_date"] ?></li>
                        <li>
                            <?php echo $row["comm_details"] ?>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<div id="pagination">
    <?php echo $list_page; ?>
</div>