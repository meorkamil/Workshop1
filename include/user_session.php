<?php
require 'db.php';

session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id']) )
{
  echo "<script>window.location.assign('login.php')</script>";
    
}
$user_id = $_SESSION['id'];

       

?>