<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

abstract class AbstractPagination {

    protected int $page;
    private string $moduleLink;

    public function __construct(string $moduleLink) {
        $this->moduleLink = $moduleLink;

        /* if path arg page doesnt exists set $page as default */
        if(isset($_GET["page"]))
            $this->page = $_GET["page"];
        else
            $this->page = 1;
    }

    protected function back(int $page) : string {
        /* $page can not go below 1 */
        return ($page > 1) ? "$this->moduleLink&page=" . --$page : "#";
    }

    protected function next(int $page) : string {
        return "$this->moduleLink&page=" . ++$page;
    }

    protected function dataLink() : string {
        return "$this->moduleLink&page=$this->page&action=data";
    }
}