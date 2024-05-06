<?php 
    session_start();   
    $prd_id = $_GET["prd_id"];
    if(isset($_SESSION["cart"]))
    {
        unset($_SESSION["cart"][$prd_id]);
        if(count($_SESSION["cart"])==0)
            {
                unset($_SESSION["cart"]);
            }
       
    }
    header("location: ../../index.php?page_layout=cart");
?>