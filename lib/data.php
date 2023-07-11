<?php

require_once '../../../../init.php';

use WHMCS\Module\Addon\Addon_WHMCS_Module\ClientsData;

$clientsData = new ClientsData();
$records = $clientsData->getClientsData($_GET["page"], $_GET["size"]);

header('Content-Type: application/json');
echo  $clientsData->formatDataToJson($records);

