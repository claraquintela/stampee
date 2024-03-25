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

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $product = new Product;
            $selectId = $product->selectId($data['id']);
            $image = $product->getImage($data['id']);

            if ($selectId) {
                return View::render('product/show', ['product' => $selectId, 'image' => $image]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }


    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $product = new Product;
            $selectId = $product->selectId($data['id']);
            if ($selectId) {
                return View::render('product/edit', ['product' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function update($data, $get)
    {
        $validator = new Validator;
        $data['dateTime'] = date('d-m-Y H:i:s');
        $validator->field('nom', $data['nom'])->required()->min(2)->max(100);
        $validator->field('description', $data['description'])->required()->max(255);
        $validator->field('prix', $data['prix'])->required();
        $validator->field('annee', $data['annee'])->required();
        $validator->field('pays', $data['pays'])->required()->min(2)->max(50);
        $validator->field('condition_timbre', $data['condition_timbre'])->required();

        $data['image'] = $data['dateTime'] . $_FILES["image"]["name"];
        $data['image'] = preg_replace('/[:\s\-]/', '',  $data['image']);

        $validator->field('image', $data['image'])->uploadImage($_FILES);


        if ($validator->isSuccess()) {
            $product = new Product;
            $update = $product->update($data, $get['id']);

            if ($update) {
                return View::redirect('product/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('product/edit', ['errors' => $errors, 'product' => $data]);
        }
    }

    public function delete($data)
    {
        $product = new  Product;
        $delete = $product->delete($data['id']);
        if ($delete) {
            return View::redirect('product');
        } else {
            return View::render('error');
        }
    }
}
