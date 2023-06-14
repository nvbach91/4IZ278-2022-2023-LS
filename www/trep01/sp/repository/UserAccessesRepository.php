<?php

class UserAccessesRepository extends Repository
{
    public function getUserAccesses($id_user)
    {
        $sql = "SELECT * FROM accesses INNER JOIN userAccesses ON accesses.id_access = userAccesses.access_id WHERE user_id = :id_user";
        $params = [
            ":id_user" => $id_user
        ];

        return $this->db->select($sql,$params);
    }

    public function addUserAccess($access_id,$user_id,$userAccess_note)
    {
        $sql = "INSERT INTO userAccesses SET access_id = :access_id, user_id = :user_id,userAccess_note = :userAccess_note";
        $params = [
            ":access_id" => $access_id,
            ":user_id" => $user_id,
            ":userAccess_note" => $userAccess_note
        ];

        return $this->db->insert($sql,$params);
    }

    public function deleteUserAccess($access_id)
    {
        $sql = "DELETE FROM userAccesses WHERE access_id = :access_id";
        $params = [
            ":access_id" => $access_id,
        ];

        $this->db->delete($sql,$params);
    }

}