<?php
  include "../model/pdo.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "../model/global_function.php";
  include "../admin/model/admin_product_function.php";
  session_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require '../phpMailer/src/Exception.php';
  require '../phpMailer/src/PHPMailer.php';
  require '../phpMailer/src/SMTP.php';

  
  $id_user = $_SESSION['tai_khoan']['id_tai_khoan'];
  $user_login = $_SESSION['tai_khoan'];
  $user_info_global = loading_user_info($user_login['id_tai_khoan']);


  $cart_products = get_cart_products($id_user);
  $cart_products_length = count($cart_products);

  include "./user_info_views/header.php";
  $user_info = loading_user_info($id_user);
  include "./user_info_views/content.php";

  if(isset($_GET['section']) && $_GET['section'] != ''){
    $section = $_GET['section'];

    switch($section){
      case "profile":
        $user_info = loading_user_info($id_user);
        include "user_info_views/section/profile/profile.php";
        break;
      
        case "update_profile":
          $user_info = loading_user_info($id_user);
          // update
          if(isset($_POST['isUpdateProfile'])){
            $fullName = $_POST['ho_va_ten'];
            $phone_number = $_POST['sdt'];
            $avatar = $_FILES['avatar'];

            $errors = array(
              "fullNameErr" => "",
              "phone_number_err" => "",
              "avatar_err" => ""
            );

            $sql_select_to_all_account = "SELECT * FROM `tai_khoan`";
            $all_account = pdo_query($sql_select_to_all_account);

            if($fullName == ''){
              $errors['fullNameErr'] = "Họ và tên chưa có dữ liệu!";
            }


            // sdt
            $phone_checker_regex = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/i";
            if($phone_number == ''){
              $errors['phone_number_err'] = "Số điện thoại chưa có dữ liệu!";
            } else if(!preg_match("$phone_checker_regex", $phone_number)){
              $errors['phone_number_err'] = "Số điện thoại không đúng định dạng!";
            }
            

            // img
            $type_img_arr = array('jpg', 'jpeg', 'png');
            if($avatar['size'] <= 0){
              $errors['avatar_err'] = '';
            } else {
              $fileType = pathinfo($avatar['name'], PATHINFO_EXTENSION);
              if(!in_array($fileType, $type_img_arr)){
                $errors['avatar_err'] = "Chỉ cho phép ảnh dạng PNG hặc JPG!";
              }
            }
            

            $error_count = 0;
            foreach($errors as $error_value){
              if($error_value != ''){
                $error_count += 1;
              }
            }

            if($error_count == 0){
              if($avatar['size'] <= 0){
                $img_url = "$user_info[avatar]";
              } else {
                $img_url = '';
                if($avatar['tmp_name'] != ''){
                    $folderName = 'user_info_views/user_img/';
                    $fileName = uniqid() . '_' . $avatar['name'];
                    move_uploaded_file($avatar['tmp_name'], $folderName . $fileName);
                    $img_url = $folderName . $fileName;
                }
              }
              
              $sql_update_user_profile = "UPDATE `tai_khoan` SET `ho_va_ten` = '$fullName', `sdt` = '$phone_number', `avatar` = '$img_url' WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]'";
              pdo_execute($sql_update_user_profile);
              header("location: index.php?section=update_profile");
              ob_end_flush();
            } else {
              header("location: index.php?section=update_profile&isError=true&fullNameErr=$errors[fullNameErr]&phone_number_err=$errors[phone_number_err]&avatar_err=$errors[avatar_err]");
            }
          }

          include "user_info_views/section/profile/update_profile.php";
          break;

        case "bill_list":
          if(isset($_GET['isGetOrder'])){
            $bill_id = $_GET['bill_id'];
            if($_GET['isGetOrder'] == 1){
              $sql_update_bill_delivery = "UPDATE `chi_tiet_bill` SET `trang_thai_bill` = '2' WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]' and `id_bill` = '$bill_id'";
              pdo_execute($sql_update_bill_delivery);
              header("location: index.php?section=bill_list&bill_status=2");
            } else if($_GET['isGetOrder'] == 0){
              $sql_update_bill_delivery = "UPDATE `chi_tiet_bill` SET `trang_thai_bill` = '3' WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]' and `id_bill` = '$bill_id'";
              pdo_execute($sql_update_bill_delivery);


              $sql_loading_bill_cancel = "SELECT * FROM `chi_tiet_bill` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]' and `trang_thai_bill` = 3";
              $bill_cancel_arr = pdo_query($sql_loading_bill_cancel);
              if(sizeof($bill_cancel_arr) == 2){
                
                  $mail = new PHPMailer(true);

                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'closetfashion203@gmail.com';
                  $mail->Password = 'mkeupgwabxllatjj';
                  $mail->SMTPSecure = 'ssl';
                  $mail->Port = 465;
      
                  $mail->setFrom('closetfashion203@gmail.com'); 
                  $mail->addAddress($user_info_global['email']);
                  $mail->isHTML(true);
                  $mail->Subject = 'CANH BAO KHOA TAI KHOAN NGUOI DUNG!';
      
                  $mail->Body = "<h2>Cảnh bảo khoá tài khoản người dùng.</h2>";
                  $mail->Body .= "<h3>Vì hành động huỷ đơn hàng của bạn gây ảnh hưởng tới CLOSET, nếu còn tiếp tục huỷ đơn thì chúng tôi sẽ cân nhắc việc khoá tài khoản của bạn trong tương lai!</h3>";
      
                  $mail->send();
              } else if(sizeof($bill_cancel_arr) == 3){
                $sql_ban_account = "UPDATE `tai_khoan` SET `trang_thai` = 2 WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]'";
                  pdo_execute($sql_ban_account);
                
                  $mail = new PHPMailer(true);

                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'closetfashion203@gmail.com';
                  $mail->Password = 'mkeupgwabxllatjj';
                  $mail->SMTPSecure = 'ssl';
                  $mail->Port = 465;
      
                  $mail->setFrom('closetfashion203@gmail.com'); 
                  $mail->addAddress($user_info_global['email']);
                  $mail->isHTML(true);
                  $mail->Subject = 'THONG BAO KHOA TAI KHOAN NGUOI DUNG!';
      
                  $mail->Body = "<h2>Thông báo khoá tài khoản người dùng.</h2>";
                  $mail->Body .= "<h3>Vì bạn đã vượt quá số lần huỷ hàng cho phép, chúng tôi sẽ khoá tài khoản của bạn để tránh ảnh hưởng tới CLOSET!</h3>";
      
                  $mail->send();
              }
              
              header("location: index.php?section=bill_list&bill_status=3");
            }
          }


          if(isset($_GET['bill_status']) && $_GET['bill_status'] != ''){
            $bill_status_form_url = $_GET['bill_status'];

            $sql_loading_bill = "SELECT * FROM `chi_tiet_bill` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]' and `trang_thai_bill` = '$bill_status_form_url' ORDER BY `id_bill` DESC";
            $bill_arr = pdo_query($sql_loading_bill);
          } else {
            $sql_loading_bill = "SELECT * FROM `chi_tiet_bill` WHERE `id_tai_khoan` = '$user_login[id_tai_khoan]' ORDER BY `id_bill` DESC";
            $bill_arr = pdo_query($sql_loading_bill);
          }

          include "user_info_views/section/bill/bill_list.php";
          break;

        case "update_email":
          $old_email = $_GET['email'];
          if(isset($_POST['data__update--btn'])){
            $new_email = $_POST['new_data_value'];

            // check if email exits
            $sql_loading_all_email = "SELECT * FROM `tai_khoan`";
            $all_email = pdo_query($sql_loading_all_email);

            $isEmailExits = false;
            foreach($all_email as $val){
              if($val['email'] == $new_email){
                $isEmailExits = true;
                break;
              }
            }

            if($isEmailExits == false){
              $sql_update_email = "UPDATE `tai_khoan` SET `email` = '$new_email' WHERE `id_tai_khoan` = '$user_info_global[id_tai_khoan]'";
              pdo_execute($sql_update_email);
              header("location: index.php?section=update_profile");
              ob_end_flush();
            } else {
              function_alert("Email bạn nhập đã tồn tại!");
            }


          }
          include "./user_info_views/section/profile/update_email.php";
          break;
        case "update_password":
          if(isset($_POST['data__update--btn'])){
            $old_pass = $_POST['old_data_value'];
            $new_pass = $_POST['new_data_value'];

            if(password_verify("$old_pass", $user_info_global['password']) == true){
              $password_hash = password_hash("$new_pass", PASSWORD_DEFAULT);
              
              $sql_update_password = "UPDATE `tai_khoan` SET `password` = '$password_hash' WHERE `id_tai_khoan` = '$user_info_global[id_tai_khoan]'";
              pdo_execute($sql_update_password);

              header("location: index.php?section=update_profile");
              ob_end_flush();
            } else {
              function_alert("Mật khẩu cũ không khớp!");
            }
          }
          include "./user_info_views/section/profile/update_password.php";
          break;
    
        default:
        include "user_info_views/section/profile/profile.php";
        break;
    }
  } else{
    include "user_info_views/section/profile/profile.php";
  }

  include "./user_info_views/footer.php";
?>