<?php

namespace Classes\Models;

require_once PROJECT_ROOT_PATH . "/Classes/Models/Model.php";
class UserModel extends Model
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}