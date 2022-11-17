<?php
  include "model/pdo.php";
  include "views/header.php";
  
  if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];

    switch($page){
      case "homepage":
        include "views/homepage.php";
        $sql = "SELECT * FROM san_pham";
        $product = pdo_query($sql); 
        break;
      case "product":
        include "views/product_page.php";
        break;
      case "contact":
        include "views/homepage.php";
        break;
      case "about":
        include "views/homepage.php";
        break;
      default:
        include "views/homepage.php";
        $sql = "SELECT * FROM san_pham";
        $product = pdo_query($sql); 
        break;
    }
  } else {
    include "views/homepage.php";
    $sql = "SELECT * FROM san_pham";
    $product = pdo_query($sql); 
  }

  include "views/footer.php";
?>