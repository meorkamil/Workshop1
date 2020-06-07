<?php
$con = mysqli_connect("localhost","root","","sesms");
// Check connection
if (mysqli_connect_errno())
  {
    echo  '<div class="alert alert-danger"><strong>Error!</strong> Fail to connect to MySQL.<br><a href="/eKenderaanTrouble/restore.php" class="alert-link"><h5><i class="fa fa-database" aria-hidden="true"></i> Restore Your Database <strong>Now ! </strong></h5></a>or Contact <strong>MK | 97 Development Team</div>';

  }

?>