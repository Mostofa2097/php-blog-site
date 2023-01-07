<h3>welcom</h3>
<?php
session_start();
 if(isset($_SESSION['user_data'])){

 echo $_SESSION['user_data']['0'];
 unset($_SESSION['user_data']);

 }
 ?>