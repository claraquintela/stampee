<?php

namespace App\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ProductController
{
    public function __construct()
    {
        Auth::session();
    }

    public function create()
    {
        return View::render('product/create');
    }

    public function store($data)
    {
        $validator = new Validator;
        $data['dateTime'] = date('Y-m-d H:i:s');
        $validator->field('nom', $data['nom'])->required()->min(2)->max(100);
        $validator->field('description', $data['description'])->required()->max(255);
        $validator->field('prix', $data['prix'])->required();
        $validator->field('annee', $data['annee'])->required();
        $validator->field('pays', $data['pays'])->required()->min(2)->max(50);
        $validator->field('condition_timbre', $data['condition_timbre'])->required();


        error_log(print_r($data, true));
        error_log(print_r($_FILES, true));
        $data['image'] = $data['dateTime'] . $_FILES["image"]["name"];
        $data['image'] = preg_replace('/[:\s\-]/', '',  $data['image']);

        $validator->field('image', $data['image'])->uploadImage($_FILES);

        if ($validator->isSuccess()) {
            $product = new Product;
            $insert = $product->insert($data);

            if ($insert) {
                return View::redirect('product/index');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('product/create', ['errors' => $errors, 'product' => $data]);
        }
    }

    public function index()
    {
        if (Auth::session()) {
            $product = new Product;
            $select = $product->selectByUser($_SESSION['user_id']);

            if ($select) {
                return View::render('product/index', ['product' => $select]);
            } else {
                return View::render('error');
            }
        }
    }
}
