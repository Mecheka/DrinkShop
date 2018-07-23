<?php

require_once 'db_functions.php';
$db = new DB_functions();

$response = array();
if (isset($_POST['menuId'])) {
    
    $menuid = $_POST['menuId'];

    $drinks = $db->getDrinkByMenuID($menuid);

    echo json_encode($drinks);
} else {
    $response["error_msg"] = "Required parameter (menuId) is missing!";
    echo json_encode($response);
}
?>

