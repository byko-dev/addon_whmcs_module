<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

use WHMCS\Module\Addon\Addon_WHMCS_Module\Controller;
class AdminDispatcher {
    public function dispatch(string $action, string $moduleLink, int $tableSize) : string {
        if(!$action) $action = 'index';


        $controller = new Controller($moduleLink, $tableSize);
        if(is_callable([$controller, $action])){
            return $controller->$action();
        }
        return "<p> Error: Invalid action requested </p>";
    }
}
