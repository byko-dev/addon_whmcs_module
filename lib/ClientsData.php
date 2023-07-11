<?php

namespace WHMCS\Module\Addon\Addon_WHMCS_Module;

use WHMCS\User\Client;

class ClientsData {

    private function formatDataToJson(object $records) : string {
        $data = [];

        foreach ($records as $record){
            $data[] = ["id" => $record["id"], "Firstname" => $record["firstname"], "Lastname" => $record["lastname"] ,
                "Company name" => $record["companyname"], "Email" => $record["email"], "Phone" => $record["phonenumber"],
                "Created at" => $record["datecreated"]];
        }
        return json_encode($data);
    }

    public function getClientsData(int $page = 1, int $size = 3) : object {
        $offset = ($page - 1) * $size;
        return Client::limit($size)->offset($offset)->get();
    }

    public function getDataFromVirtualFile(object $records) : string {
        $path = "user_data.json";
        file_put_contents($path, $this->formatDataToJson($records));
        return $path;
    }
}