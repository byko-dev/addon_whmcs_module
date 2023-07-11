<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

class AdminDispatcher extends AbstractPagination {

    private ClientsData $clientsData;
    private int $tableSize;

    public function __construct(string $moduleLink, int $tableSize){
        parent::__construct($moduleLink);

        $this->clientsData = new ClientsData();
        $this->tableSize = $tableSize;
    }

    public function index() {
        //links to pagination table
        $backPage = $this->back($this->page);
        $nextPage = $this->next($this->page);

        //gets clients data using small chunks
        $records = $this->clientsData->getClientsData($this->page, $this->tableSize);

        /* format data to json and save to file */
        $link = $this->clientsData->getDataFromVirtualFile($records);

        return <<<EOF
             <div>
             <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
                <table id="myTable">
                    <thead>
                        <tr> 
                            <th> id </th>
                            <th> Firstname </th>
                            <th> Lastname </th>
                            <th> Company name</th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Created at </th>
                        </tr>
                    </thead>
                </table>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js" data-turbolinks-track="true"></script>

                <script> 
                    
                    $(document).ready(function() {
                        $('#myTable').DataTable({
                            'ajax': {
                                url: '$link',
                                type: 'GET',
                                dataType: 'json',
                                dataSrc: ''
                            },
                            "deferRender": true,
                            columns: [
                                { data: 'id' },
                                { data: 'Firstname' },
                                { data: 'Lastname' },
                                { data: 'Company name' },
                                { data: 'Email' },
                                { data: 'Phone' },
                                { data: 'Created at' }],
                            paging: false
                        });
                    });
                </script>
                <div style="display: flex; justify-content: space-between;">
                    <a href="$backPage"> Back page </a>  
                    <a href="$nextPage"> Next page </a>
                </div>
             </div>    
             EOF;
    }
}