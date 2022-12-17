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

  function update_user_info($user_id, $sdt, $email, $fullName){
    $sql_update_user_info = "UPDATE `tai_khoan` SET `ho_va_ten` = '$fullName', `sdt` = '$sdt', `email` = '$email' WHERE `id_tai_khoan` = '$user_id'";
    pdo_execute($sql_update_user_info);
    header("location: index.php?page=payment");
    ob_end_flush();
  }

  function change_address($user_id ,$address_1, $address_2, $address_3, $address_4){
    // check if address none;
    $sql_loading_user_address = "SELECT * FROM `dia_chi` WHERE `id_tai_khoan` = '$user_id'";
    $loading_user_address = pdo_query($sql_loading_user_address);

    if(sizeof($loading_user_address) <= 0){
      $sql_change_address = "INSERT INTO `dia_chi` (`id_tai_khoan`, `tinh__thanh_pho`, `quan__huyen`, `phuong__xa`, `dia_chi_chi_tiet`) VALUES ('$user_id','$address_1','$address_2','$address_3','$address_4')";
      pdo_execute($sql_change_address);
    } else {
      $sql_change_address = "UPDATE `dia_chi` SET `tinh__thanh_pho` = '$address_1', `quan__huyen` = '$address_2', `phuong__xa` = '$address_3', dia_chi_chi_tiet = '$address_4' WHERE id_tai_khoan = '$user_id'";
      pdo_execute($sql_change_address);
    }
    header("location: index.php?page=payment");
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

  function loading_product_user_without_id_user(){
    $sql_loading_user_without_id_user = "SELECT * FROM `tai_khoan`";
    $users = pdo_query($sql_loading_user_without_id_user);
    return $users;
  } 

  function insert_comment($product_id, $user_id, $comment_content, $star_rating, $date_comment){
    $sql_insert_comment = "INSERT INTO `binh_luan` (`id_binh_luan`, `id_sp`, `id_tai_khoan`, `noi_dung_binh_luan`, `sao_danh_gia`, `thoi_gian_binh_luan`) VALUES (NULL, '$product_id', '$user_id', '$comment_content', '$star_rating', '$date_comment');";
    pdo_execute($sql_insert_comment);
  }
?>