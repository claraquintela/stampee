<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Models\Product;

class EnchereController
{
    public function index()
    {
        if (Auth::session()) {
            $enchere = new Enchere;
            $select = $enchere->select();

            if ($select) {
                return View::render('enchere', ['enchere' => $select]);
            } else {
                return View::render('error');
            }
        }
    }

    public function store($data)
    {
        error_log("entrei na função store de enchere");
        error_log($data['stampee_produit_id'] . "esta aqui é a data");
        $validator = new Validator;
        $data['dateTime'] = date('Y-m-d H:i:s');
        $validator->field('prix', $data['prix'])->required()->min(2)->max(100);

        if ($validator->isSuccess()) {
            $enchere = new Enchere;
            $insert = $enchere->insert($data);

            if ($insert) {

                $product = new Product;
                $updateStatus = $product->updateStatusProduct($data['stampee_produit_id'], $data['status']);

                if ($updateStatus) {
                    return View::redirect('product/index');
                } else {
                    return View::render('error');
                }
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('product/index', ['errors' => $errors, 'product' => $data]);
        }
    }


    public function deactiverEnchere($data)
    {
        error_log($data['stampee_produit_id'] . "esta aqui é a data");
        $product = new Product;
        $updateStatus = $product->updateStatusProduct($data['stampee_produit_id'], $data['status']);

        if ($updateStatus) {
            return View::redirect('product/index');
        } else {
            return View::render('error');
        }
    }
}
