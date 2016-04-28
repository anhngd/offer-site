<?php
include("managerOffer/function/config.php");
$query_change_password=mysql_query("Update admin set adminPass='f5f091a697cd91c4170cda38e81f4b1a' where adminName='admin'");

echo "Reset password success! Username:admin - Password:123456788";

?>