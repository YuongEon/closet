<?php
  include "../model/pdo.php";
  include "../model/global_function.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "./login_views/header.php";


  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require '../phpMailer/src/Exception.php';
  require '../phpMailer/src/PHPMailer.php';
  require '../phpMailer/src/SMTP.php';

  $login_method = isset($_GET['login_method'])? $_GET['login_method'] : NULL;
  switch($login_method){
    case "login":
      if(isset($_POST['login__btn'])){
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $password = $_POST['password'];

        $method_login_string = '';
        $email_checker_regex ="/^[a-zA-Z]+[a-zA-Z0-9]*\@([a-zA-Z]+(\.)?)+$/i";
        if(preg_match($email_checker_regex, $usernameOrEmail)){
          $method_login_string = 'email';
        } else {
          $method_login_string = 'username';
        }

        $sql_select_user_login = "SELECT * FROM `tai_khoan` WHERE `$method_login_string` = '$usernameOrEmail'";
        $login_user = pdo_query_one($sql_select_user_login);
    
        $errors = array("login_method_err" => '', "password_err" => '', "both_err" => '');
        if($usernameOrEmail == ''){
          $errors['login_method_err'] =  "$method_login_string chưa có dữ liệu!";
        }
        if($password == ''){
          $errors['password_err'] = "Mật khẩu chưa có dữ liệu!";
        }
        if($usernameOrEmail != '' && $password != ''){
          if($usernameOrEmail != $login_user["$method_login_string"]){
            $errors["both_err"] = "$method_login_string không tồn tại!";
          } else if(!password_verify("$password", $login_user['password'])){
            $errors['both_err'] = "Mật khẩu không chính xác!";
          } else if($usernameOrEmail == $login_user["$method_login_string"] && password_verify("$password", $login_user['password'])){
            session_start();
            $_SESSION["tai_khoan"] = $login_user;
            header("location: ../index.php");
            ob_end_flush();
          }
        }
      }

      include "./login_views/login_section.php";
      break;

    case "signup":
      if(isset($_POST['signup__btn'])){
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $full_name = $_POST['username'];

        $sql_select_to_all_account = "SELECT * FROM `tai_khoan`";
        $all_account = pdo_query($sql_select_to_all_account);

        $errors = array(
          "email_err" => '',
          'phone_number_err' => '',
          'username_err' => '',
          'password_err' => '',
        );
        // check username
        if($username == ""){
          $errors['username_err'] = 'Tên đăng nhập chưa có dữ liệu!';
        } else {
          foreach($all_account as $account_value){
            if($account_value['username'] == $username){
              $errors['username_err'] = 'Tên đăng nhập đã tồn tại!';
            }
          }
        }

        // check email
        $email_checker_regex ="/^[a-zA-Z]+[a-zA-Z0-9]*\@([a-zA-Z]+(\.)?)+$/i";
        if($email == ''){
          $errors['email'] = 'Email chưa có dữ liệu!';
        } else if(!preg_match("$email_checker_regex", $email)){
          $errors['email'] = "Email không đúng định dạng";
        } else {
          foreach($all_account as $account_value){
            if($account_value['email'] == $email){
              $errors['email_err'] = 'Email đã tồn tại!';
            }
          }
        }
        
        // check phone_number
        $phone_checker_regex = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/i";
        if($phone_number == ''){
          $errors['phone_number_err'] = "Số điện thoại chưa có dữ liệu";
        } else if(!preg_match("$phone_checker_regex", $phone_number)){
          $errors['phone_number_err'] = "Số điện thoại không đúng định dạng";
        }

        // check password 
        if($password == ''){
          $errors['password_err'] = "Mật khẩu chưa có dữ liệu";
        }

        $check_if_err = 0;
        foreach($errors as $errors_value){
          if($errors_value != ''){
            $check_if_err += 1;
          }
        }

        if($check_if_err == 0){
          $password_hash = password_hash("$password", PASSWORD_DEFAULT);

          $sql_insert_user = "INSERT INTO `tai_khoan` (`id_tai_khoan`, `ho_va_ten`, `username`, `password`, `avatar`, `email`, `sdt`, `loai_tai_khoan`, `trang_thai`) VALUES (NULL, '$full_name', '$username', '$password_hash', NULL, '$email', '$phone_number', '0', '1')";
          pdo_execute($sql_insert_user);

          $loginUser = "SELECT * FROM `tai_khoan` WHERE username = '$username'";
          $loginUser = pdo_query_one($loginUser);

          session_start();
          $_SESSION["tai_khoan"] = $loginUser;
          header("location: ../index.php");
          ob_end_flush();
        }
      }

      include "./login_views/signup_section.php";
      break;

      case "forgot_pass":
        if(isset($_POST['send__code__btn'])){
          $email = $_POST['email'];
        
          $select_all_account = "SELECT * FROM `tai_khoan`";
          $all_account = pdo_query($select_all_account);

          $isExits = false;
          foreach($all_account as $val){
            if($val['email'] == $email){
              $isExits = true;
              break;
            }
          }

          if($isExits == true){
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'closetfashion203@gmail.com';
            $mail->Password = 'mkeupgwabxllatjj';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('closetfashion203@gmail.com'); 
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'CLOSET PASSWORD CODE!';

            $mail->Body = "<h2>Nhấp vào link để đổi mật khẩu!</h2>";
            $mail->Body .= "http://localhost:8888/closet/login_method/index.php?login_method=get_new_pass&email=$email";

            $mail->send();
          } else{
            function_alert("Email không tồn tại");
          }
        }

        include "./login_views/forgot_pass.php";
        break;

        case "get_new_pass":
          $email = $_GET['email'];

          if(isset($_POST['get__new__pass__btn'])){
            $new_password = $_POST['password'];
            $email_request = $_POST['email_request'];

            $password_hash = password_hash("$new_password", PASSWORD_DEFAULT);
            var_dump($email_request);
            $sql_update_pass = "UPDATE `tai_khoan` SET `password` = '$password_hash' WHERE `email` = '$email_request'";
            pdo_execute($sql_update_pass);
            header("location: index.php?login_method=login");
            ob_end_flush();
          }

          include "./login_views/get_new_pass.php";
          break;

    default:
      include "./login_views/login_section.php";
      break;
  }

  include "./login_views/footer.php"
?>