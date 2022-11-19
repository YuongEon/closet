<?php
  function best_sale_product($sql){

  }

  function flash_sale_product($sql){
    
  }

  function all_product($sql){
    $all_product = pdo_query($sql);
    return $all_product;
  }
?>