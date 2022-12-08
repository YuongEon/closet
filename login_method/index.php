<?php
  include "../model/pdo.php";
  include "../model/global_function.php";
  include "../model/san_pham_funtion.php";
  include "../model/user_function.php";
  include "./login_views/header.php";

  $login_method = isset($_GET['login_method'])? $_GET['login_method'] : NULL;
  switch($login_method){
    case "login":
      include "./login_views/login_section.php";
      break;

    case "signup":
      if(isset($_POST['signup__btn'])){
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $full_name = $_POST['username'];

        $sql_insert_user = "INSERT INTO `tai_khoan` (`id_tai_khoan`, `ho_va_ten`, `username`, `password`, `avatar`, `email`, `sdt`, `loai_tai_khoan`) VALUES (NULL, '$full_name', '$username', '$password', NULL, '$email', '$phone_number', '0')";
        pdo_execute($sql_insert_user);

        $loginUser = "SELECT * FROM `tai_khoan` WHERE username = '$username'";
        $loginUser = pdo_query_one($loginUser);
        
        session_start();
        $_SESSION["tai_khoan"] = $loginUser;
        header("location: ../index.php");
        ob_end_flush();
      }

      include "./login_views/signup_section.php";
      break;

    default:
      include "./login_views/login_section.php";
      break;
  }

  include "./login_views/footer.php"
?>