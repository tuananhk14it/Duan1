<?php
    //Ham phan trang
    function pagination($row_per_page=5, $sql){
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }
        else{
            $page=1;
        }
        $per_row= $page*$row_per_page - $row_per_page;
        $sql .= " LIMIT $per_row,$row_per_page ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    //Ham phan trang theo danh sach page
    function listPage($ul='<ul class="pagination">', $pre_li='<li class="page-item"><a class="page-link"'){
        $list_pages= $ul;
                        //Page_Prev
                        $page_prev=$page-1;
                        if($page_prev==0){
                            $page_prev=1;
                        }
                        $list_pages.=  $pre_li.'href="index.php?page_layout=product&page='.$page_prev.'">&laquo;</a></li>';
                        //End Page_Prev
                        for($i=1;$i<=$total_pages;$i++){
                            $list_pages.='<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
                        }
                        //Page_Next
                        $page_next=$page+1;
                        if($page_next>$total_pages){
                            $page_next=$total_pages;
                        }
                        $list_pages.= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">&raquo;</a></li>';
        $list_pages .= "</ul>";
    }
?>
