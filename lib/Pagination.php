<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

abstract class Pagination {

    protected int $page;
    private string $moduleLink;
    public function __construct(string $moduleLink){
        $this->moduleLink = $moduleLink;

        if(isset($_GET["page"]))
            $this->page = $_GET["page"];
        else
            $this->page = 1;
    }

    protected function back(int $page) : string {
        if($page > 1) --$page;
        return $this->moduleLink . "&page=" . $page;
    }

    protected function next(int $page) : string {
        return $this->moduleLink . "&page=" . ++$page;
    }
}