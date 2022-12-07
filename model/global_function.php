<?php 
  function function_alert($message) {
    echo "<script>alert('$message');</script>";
  }
  //convert money
  function currency_format($number, $suffix = '₫') {
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . " {$suffix}";
    }
  }
?>