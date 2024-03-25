<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;


class EnchereController
{
    public function index()
    {
        if (Auth::session()) {
            $enchere = new Enchere;
            $select = $enchere->select();

            if ($select) {
                return View::render('enchere/index', ['enchere' => $select]);
            } else {
                return View::render('error');
            }
        }
    }
}
