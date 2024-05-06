
<script>
    // objDel là đối tượng cần xóa, tbl_objDel là đối tượng cần xóa tại bảng trong CSDL

    //Hàm thông báo lỗi khi xóa
    function msgDelError(objTbl,tbl_objDel)
    {
        window.alert(objTbl + "không thể xóa! vì đang tồn tại ở bảng "+ tbl_objDel);
        history.back();
    }
    //Hàm thông báo xóa thành công
    function msgDelComplete(objTbl)
    {
        window.alert(objTbl + " đã được xóa thành công");
        history.back();
    }
    //Hàm thống bào lỗi khi xóa trong đó có objAdd cần thêm vào
    function msgAddError(objTbl,objAdd,tbl_objAdd)
    {
        window.alert(objTbl + objAdd + " không thêm mới! vì đã có trong bảng "+ tbl_objAdd);
        history.back();
    }
    function msgDelComplete(objTbl, tbl_objAdd)
    {
        window.alert(objTbl + " đã được xóa thành công");
        history.back();
    }


</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- cÓ RỒI -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
   <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thông báo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Bạn có muốn xóa thông tin này không
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

</body>
</html>
