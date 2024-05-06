<?php
if (isset($_GET["page_layout"])) {
    $cat_id = $_GET["cat_id"];
    $cat_name = $_GET["cat_name"];
};
if (isset($_GET['page_number'])) {
        $page_num = $_GET['page_number'];
    } else {
        $page_num = 1;
    };

$rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE cat_id = $cat_id"));
$rows_per_page = 5;
$total_rows = $rows;
$total_page = ceil($total_rows / $rows_per_page);
$per_row = $page_num * $rows_per_page - $rows_per_page;
$sql = "SELECT * 
FROM product
WHERE cat_id = $cat_id
ORDER BY prd_id DESC
LIMIT $per_row, $rows_per_page";
$query = mysqli_query($conn, $sql);


$list_pages = '<nav aria-label="Page navigation example">
<ul class="pagination">';
$page_prev = $page_num - 1;
if ($page_prev == 0) 
{
    $page_prev = 1;
}
if ($row>0)
{
    $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id=' . $cat_id . '&cat_name=' . $cat_name . '&page_number=' . $page_prev . '">Trước</a></li>';
}
else
{
    $list_pages .= '<li class="page-item"><span class="page-link">Trước</span></li>';
}


for ($i = 1; $i <= $total_page; $i++) {
    $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id=' . $cat_id . '&cat_name=' . $cat_name . '&page_number=' . $i . '">' . $i . '</a></li>';
}
$page_next = $page_num  + 1; 
if ($page_next > $total_page) {
    $page_next = $total_page;
}

if ($page_next <= $total_page)
{
    $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id=' . $cat_id . '&cat_name=' . $cat_name . '&page_number=' . $page_next . '">Sau</a></li>
    </ul>
</nav>';
}
else
{
    $list_pages .= '<li class="page-item"><span class="page-link">Sau</span></li>';
}
?>

<!--	List Product	-->
<div class="products">
    <h3> <?php echo $cat_name; ?> (hiện có <?php echo $rows ?> sản phẩm)</h3>
    <?php
        $sp = 0;
        $dem = 0;
        while ($row = mysqli_fetch_array($query)) {
        if($dem == 0) {
        ?>
        <div class="product-list card-deck">
        <?php
        };
        ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
            <h4><a href="#"><?php echo $row['prd_name']; ?></a></h4>
            <p>Giá Bán: <span><?php echo formatPrice($row['prd_price']); ?> đ</span></p>
        </div>
        <?php
        $dem ++;
        $sp ++;
        if($dem == 3){
        ?>
        </div>
        <?php
            $dem = 0;
        };
        };
        if ( $sp %3 != 0){
        ?>
        </div>
        <?php
        };
        ?>
</div>
<!--	End List Product	-->

<div id="pagination">
<?php echo $list_pages; ?>
</div>