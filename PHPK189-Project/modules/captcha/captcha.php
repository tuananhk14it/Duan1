<?php

  session_start();  
  //Khai báo và tạo ra một khung ảnh có độ rộng 120x30.
  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");//Create a new true color image

  //Đặt nền thành màu trắng và phân bổ màu vẽ
  $background = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
  //Thực hiện tổ nền màu trắng (background) cho image.
  imagefill($image, 0, 0, $background);
  //Thiết lập màu của đường kẻ
  $linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
  //Thiết lập màu cho text
  $textcolor = imagecolorallocate($image, 0x33, 0x33, 0x33);

  //Thực hiện vẽ ra 5 đường kẻ ngẫu nhiên
  for($i=0; $i < 6; $i++) 
  {
    //Tạo độ dầy của đường kẻ
    imagesetthickness($image, rand(1,3));
    //Vẽ đường kẻ trong image trên, tọa độ bắt đầu từ x1 =0, tọa độ y1 = random từ 0-30
    //x2=120, y2=random tu 0 đến 30,màu
    imageline($image, 0, rand(0,30), 120, rand(0,30), $linecolor);
  }
///////Tạo ảnh để chứa mã code

   //Tạo biến digit để lưu dãy số và hiển thị vào giữa ảnh  
  $digit = '';
  //Duyệt x từ 15 cho 95 mục đích để tạo ra khoảng cách giữa các số bắt đầu từ lê trái, mỗi lần tăng 20
  for($x = 15; $x <= 95; $x += 20) 
  {
    //Gán giá trị cho biến digit - Mỗi một vòng lặp gán một số ngẫu nhiên
    $digit .= ($num = rand(0, 9));
    // Mỗi một vòng lặp sẽ chèn một số ngẫu nhiên với màu là giá trị màu của textcolor
    imagechar($image, rand(3, 5), $x, rand(2, 14), $num, $textcolor);
  }
  // record digits in session variable - lưu mã code vào biến session
  //Lưu dẫy số vào biến session
  $_SESSION['digit'] = $digit;

  // display image and clean up- hiển thị mã captcha hoàn thiện
  //Định dạng png cho ảnh
  header('Content-type: image/png');
  //Xuất hình ảnh ra trình duyệt
  imagepng($image);
  ?>