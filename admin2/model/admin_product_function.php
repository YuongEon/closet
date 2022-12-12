<?php 
  function admin_insert_product($product_name, $product_img, $product_price, $product_sale_price, $product_category, $product_brand, $product_sort_desc, $product_long_desc){
    $sql_admin_insert_product = "INSERT INTO `san_pham` (`id_sp`, `ten_sp`, `mo_ta_ngan_sp`, `mo_ta_sp`, `anh_sp`, `gia_sp`, `giam_gia_sp`, `so_luong_sp_da_ban`, `loai_sp`, `brand`, `trang_thai_sp`) VALUES (NULL, '$product_name', '$product_sort_desc', '$product_long_desc', '$product_img', '$product_price', '$product_sale_price', NULL, '$product_category', '$product_brand', '1')";
    pdo_execute($sql_admin_insert_product);
  }

  function admin_insert_product_classify($product_id, $color, $size, $product_quantity){
    $sql_admin_insert_product_classify = "INSERT INTO `phan_loai` (`id_sp`, `color`, `size`, `so_luong_sp`) VALUES ('$product_id', '$color', '$size', '$product_quantity')";
    pdo_execute($sql_admin_insert_product_classify);
  }  

?>