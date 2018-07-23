<?php

require_once 'db_functions.php';
$db = new DB_functions();

$menu = $db->getMenu();
echo json_encode($menu);

?>