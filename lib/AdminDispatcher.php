<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

class AdminDispatcher extends Pagination {
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

        //format clients data to json
        $data = $this->clientsData->formatDataToJson($records);

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
                <script> 
                
                    let data = $data;
                    $(document).ready(function() {
                        $('#myTable').DataTable({
                            data: data,
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