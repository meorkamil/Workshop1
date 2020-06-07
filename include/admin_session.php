<?php
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['role'])=='admin')
{
  echo "<script>window.location.assign('login.php')</script>";
    
}
?>