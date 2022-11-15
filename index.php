<?php
  include "views/header.php";
  
  if(isset($_GET['page']) && $_GET['page'] != ""){
    $page = $_GET['page'];

    switch($page){
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
        break;
    }
  } else {
    include "views/homepage.php";
  }

  include "views/footer.php";
?>