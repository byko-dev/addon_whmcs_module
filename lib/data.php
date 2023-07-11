<?php

require_once '../../../../init.php';

use WHMCS\Module\Addon\Addon_WHMCS_Module\ClientsData;

/* default values */
$page = 1; $size = 3;

if(isset($_GET["page"]) && isset($_GET["size"])){
    $page = $_GET["page"];
    $size = $_GET["size"];
}

$clientsData = new ClientsData();
$records = $clientsData->getClientsData($page, $size);

header('Content-Type: application/json');
echo  $clientsData->formatDataToJson($records);

