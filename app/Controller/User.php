<?php

namespace App\Controllers;

use Core\BaseController;

class User extends BaseController
{
    public function showProfile($id)
    {
        $users = $this->db->query("SELECT * FROM users WHERE users.id ='$id'",true);
    }
}