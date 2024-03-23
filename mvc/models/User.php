<?php

namespace App\Models;

use App\Models\CRUD;

class User extends CRUD
{
    protected $table = "stampee_users";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'adresse', 'zipcode', 'phone', 'password', 'email', 'stampee_privilege_id'];

    public function hashPassword($password, $cost = 10)
    {
        return  password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    public function checkUser($email, $password)
    {
        $user = $this->unique('email', $email);
        if ($user) {

            echo (print_r($user, true));
            if (password_verify($password, $user['password'])) {
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['privilege_id'] = $user['stampee_privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
