<?php 
if($_SESSION["use_usertype"]>1){
   $string.="invalid access </br>";
   $string.="<a href='login_form.php'>return to login</a>";
   echo $string;
   exit();
}

?>