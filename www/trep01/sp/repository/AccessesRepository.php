<?php

class AccessesRepository extends Repository
{


    public function addAccess($access_name,$access_server,$access_username,$access_password)
    {
        $sql = "INSERT INTO accesses SET access_name = :access_name, access_server = :access_server,access_username = :access_username, access_password = :access_password ";
        $params = [
            ":access_name" => $access_name,
            ":access_server" => $access_server,
            ":access_username" => $access_username,
            ":access_password" => $access_password,
        ];


        return $this->db->insert($sql,$params);
    }

    public function deleteAccess($id_access)
    {
        $sql = "DELETE FROM accesses WHERE id_access = :id_access";
        $params = [
            ":id_access" => $id_access,
        ];

        $this->db->delete($sql,$params);
    }

}