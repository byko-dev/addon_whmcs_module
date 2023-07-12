<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Module\Addon\Addon_WHMCS_Module\AdminDispatcher;

function addon_whmcs_module_config() : array
{
    return [
        'name' => 'Addon WHMCS Module',
        'description' => 'This module provides an example WHMCS Addon Module'
            . ' which can be used as a basis for building a custom addon module.',
        'author' => 'byko-dev',
        'language' => 'english',
        'version' => '1.0',
        'fields' => [
            'tableRecords' => [
                'FriendlyName' => 'Clients records in table:',
                'Type' => 'text',
                'Size' => '10',
                'Default' => '3',
                'Description' => 'Default value = 3',
            ],
        ]
    ];
}

/**
 * Admin Area Output.
 * required Access Control => Full Administrator
 */
function addon_whmcs_module_output(array $vars) {
    $action = $_REQUEST['action'] ?? '';

    $adminDispatcher = new AdminDispatcher();
    echo $adminDispatcher->dispatch($action, $vars["modulelink"], $vars["tableRecords"]);

    /* when true, dont execute the rest of script, returns json data */
    if($action === "data") exit();
}




