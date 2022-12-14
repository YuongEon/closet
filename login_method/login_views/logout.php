<?php
  session_start();
  unset($_SESSION['tai_khoan']);
  header("location: ../../index.php");
  ob_end_flush();
?>