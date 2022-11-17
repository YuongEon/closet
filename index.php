<?php
  include "./model/pdo.php";
  include "views/header.php";
  
  if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];

    switch($page){
      case "homepage":
        $sql = "SELECT * FROM san_pham";
        $product = pdo_query($sql); 
        include "views/homepage.php";
        break;
      case "product":
        include "views/product_page.php";
        break;
      case "contact":

        break;
      case "about":

        break;
      default:
      $sql = "SELECT * FROM san_pham";
      $product = pdo_query($sql); 
      include "views/homepage.php";
        break;
    }
  } else {
    $sql = "SELECT * FROM san_pham";
    $product = pdo_query($sql); 
    include "views/homepage.php";
  }

  include "views/footer.php";
?>