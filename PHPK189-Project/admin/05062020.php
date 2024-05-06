<!-- upload file  -->
<?php
if (isset($_POST["sbm"])) {
    $file_name = $_FILES["fileupload"]["name"];
    $file_type = $_FILES["fileupload"]["type"];
    $file_size = $_FILES["fileupload"]["size"];
    $file_tmp_name = $_FILES["fileupload"]["tmp_name"];

move_uploaded_file($file_tmp_name, "phpk189/admin/img/products/" . $file_name);
echo "<p>file upload successfully !</p>";
}
?>


<form method="POST" enctype="multipart/form-data">
    <input type="file" name="fileupload" />
    <input type="submit" name="sbm" value="Upload" />

</form>