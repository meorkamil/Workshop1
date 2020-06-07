<?php
require 'include/db.php';
require 'include/admin_session.php';
require 'include/function.php';
include_once('html/menu.php');
include_once('html/head.php');

if(isset($_GET['ship'])){


      $ship = $_GET['ship'];
      shipped($ship);
  
    }
?>
<div class="main" id="show"></div>
<script>
$(document).ready(function() {

      $('#show').load('include/order_data.php');


});
</script>