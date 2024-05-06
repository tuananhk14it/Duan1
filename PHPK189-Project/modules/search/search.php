<?php
if(isset($_POST["keyword"])){
$keyword = $_POST["keyword"];
}
else {$keyword = $_GET["keyword"];}
$arr_keyword = explode( " ",$keyword);
$new_keyword = "%".implode("%" ,$arr_keyword )."%";
if(isset($_GET["page"])){
    $page = $_GET["page"];}
    else{
        $page = 1 ;
    }
    $per_page_row = 6 ; 
    $page_row = $per_page_row*$page - $per_page_row;   
    $total_rows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product WHERE prd_name LIKE         '$new_keyword' "));
    $total_page = ceil($total_rows/$per_page_row);
    $list_page = ' <ul class="pagination">';
   //PREVIOUS PAGE
   $prev_page = $page - 1 ;
   if($prev_page == 0){
       $prev_page = 1 ;
   }
   $list_page .='<li class="page-item  "><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$prev_page.'">Trang trước</a></li>';
    //page
    for($i=1;$i<=$total_page;$i++){
        
      if($page == $i){$list_page.='<li class="page-item active "><a class="page-link " href="index.php?page_layout=search&keyword='.$keyword.'&page='.$i.'">'.$i.'</a></li>';}
       else{ $list_page.='<li class="page-item "><a class="page-link " href="index.php?page_layout=search&keyword='.$keyword.'&page='.$i.'">'.$i.'</a></li>';}
     
    }

    //NEXT PAGE
    $next_page = $page + 1 ;
   if($next_page > $total_page){
       $next_page = $total_page ;}
       $list_page .='<li class="page-item  "><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$next_page.'">Trang sau</a></li>' ; 

    $list_page .='</ul> ';



$sql="SELECT * FROM product
      WHERE prd_name LIKE         '$new_keyword'             
      LIMIT $page_row,$per_page_row" ;
$query = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($query);

?>



                
                <!--	List Product	-->
                <div class="products">

                    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword ;?></span></div>
                    <?php 

                    $i = 0 ;
                    $j = 0 ;
                    while($row = mysqli_fetch_array($query)){
                        if($i == 0){
                     ?>
                    <div class="product-list card-deck">
                        <?php } ?>
                        <div class="product-item card text-center">
                            <a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"]; ?>"><img src="admin/img/products/<?php echo $row["prd_image"]; ?>"></a>
                            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"]; ?>"><?php echo $row["prd_name"]; ?></a></h4>
                            <p>Giá Bán: <span><?php echo formatPrice($row["prd_price"]); ?></span></p>
                        </div>
                      <?php
                      $i++;
                      $j++;
                      if($i == 3 ){
                          $i = 0 ;
                       ?>  
                        
                    </div>
                    <?php 
                    }
                }
                if($j % 3 !=0){
                ?>
                </div>
                <?php 
                }
                ?>
                </div>
                <!--	End List Product	-->
                
                <div id="pagination">
                <?php echo $list_page; ?>
                    <!-- <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
                    </ul>  -->
                </div>
                
           