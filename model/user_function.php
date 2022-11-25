<?php
  include "./pdo.php";
  include "./san_pham_funtion.php";

  function loading_user_info($user_id){
    $sql_loading_user_info = "SELECT * FROM tai_khoan WHERE id_tai_khoan = '$user_id'";
    $user_info = pdo_query_one($sql_loading_user_info);
    return $user_info;
  }

  function loading_user_address($user_id){
    $sql_loading_user_address = "SELECT * FROM dia_chi WHERE id_tai_khoan = '$user_id'";
    $user_address_arr = pdo_query_one($sql_loading_user_address);
    $user_address = array();
    foreach($user_address_arr as $val){
      if(is_string($val)){
        array_push($user_address, $val);
      }
    }
    return $user_address;
  }

  function update_user_info($user_id, $sdt, $email){
    $sql_update_user_info = "UPDATE tai_khoan SET sdt = '$sdt', email = '$email' WHERE id_tai_khoan = '$user_id'";
    pdo_execute($sql_update_user_info);
    header("location: index.php?page=payment_page");
    ob_end_flush();
  }

  function change_address($user_id ,$address_1, $address_2, $address_3, $address_4){
    $sql_change_address = "UPDATE dia_chi SET tinh__thanh_pho = '$address_1', quan__huyen = '$address_2', phuong__xa = '$address_3', dia_chi_chi_tiet = '$address_4' WHERE id_tai_khoan = '$user_id'";
    pdo_execute($sql_change_address);
    header("location: index.php?page=payment_page");
    ob_end_flush();
  }

  function loading_user_info_for_payment_page($user_info, $user_info_address){

    $user_info_address = array_reverse($user_info_address);
    $user_info_address = implode(" / ", $user_info_address);
    // array_push($user_info_for_payment_page, $user_info['ho_va_ten'], $user_info['sdt'], $user_info['email'], $user_info_address);
    $user_info_for_payment_page = array(
      "ho_va_ten" => $user_info['ho_va_ten'],
      "sdt" => $user_info['sdt'],
      "email" => $user_info['email'],
      "address" => $user_info_address
    );
    return $user_info_for_payment_page;
  }
?>