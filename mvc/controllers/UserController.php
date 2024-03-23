<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController
{


    public function create()
    {
        return View::render('user/create');
    }

    public function store($data)
    {

        // if ($_SESSION['privilege_id'] == 1) {
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->required()->min(2)->max(50);
        $validator->field('adresse', $data['adresse'])->required()->min(10)->max(50);
        $validator->field('zipcode', $data['zipcode'])->required()->min(5)->max(20);
        $validator->field('phone', $data['phone'])->min(10)->max(50);
        $validator->field('password', $data['password'])->required()->min(6)->max(20);
        $validator->field('email', $data['email'])->required()->max(100)->email()->unique('User');



        if ($validator->isSuccess()) {
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            // $privilege = new Privilege;
            // $privileges = $privilege->select('privilege');
            return View::render('user/create', ['errors' => $errors, 'user' => $data]);
        }
        // } else {
        //     return View::render('error');
        // }
    }

    public function index()
    {
        if (Auth::session()) {
            $user = new User;
            $select = $user->select();

            if ($select) {
                return View::render('user/index', ['user' => $select]);
            } else {
                return View::render('error');
            }
        }
    }
}
