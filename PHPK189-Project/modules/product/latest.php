<!--	Latest Product	-->
<div class="products">
    <h3>Sản phẩm mới</h3>
    <div class="product-list card-deck">
    <?php
        $sql = " SELECT * FROM product ORDER BY prd_id DESC LIMIT 6 ";
        $query = mysqli_query($conn,$sql);
        $i = 0;
        while($row = mysqli_fetch_array($query)){
            if($i==0){
    ?>
        <div class="product-item card text-center">
    <?php
            }
    ?>
            <a href="#"><img src="images/product-7.png"></a>
            <h4><a href="#">iPhone Xs Max 2 Sim - 256GB</a></h4>
            <p>Giá Bán: <span>32.990.000đ</span></p>
        </div>
    <?php
        }
    ?>
    </div>   
</div>
<!--	End Latest Product	-->