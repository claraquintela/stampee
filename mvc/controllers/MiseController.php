<?php

namespace App\Controllers;

use App\Models\Mise;
use App\Models\Product;
use App\Models\Enchere;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;


class MiseController
{


    public function create($data = [])
    {
        $enchere = new Enchere;
        $selectId = $enchere->selectEnchereById($data['id']);

        if ($selectId && isset($selectId[0]['stampee_produit_id'])) {
            $product = new Product;
            $selectProduct = $product->selectId($selectId[0]['stampee_produit_id']);

            return View::render('mise/create', ['enchere' => $selectId[0], 'product' => $selectProduct]);
        } else {
            return View::render('error');
        }
    }


    public function store($data)
    {
        if ($data['offre'] > $data['prix']) {

            $data['date'] = date('Y-m-d H:i:s');
            $mise = new Mise;
            $insert = $mise->insert($data);

            if ($insert) {
                $enchere = new Enchere;
                $update = $enchere->updatePrixActuel($data['offre'], $data['encheres_id']);

                if ($update) {
                    return View::redirect('mise/index');
                } else {
                    echo "error";
                }
            } else {
                echo "error: la valeur de l'offre doit être superieur au prix actuel";
            }
        }
    }


    public function index()
    {
        if (Auth::session()) {
            $mise = new Mise;
            $miseListe = $mise->selectMiseByUser($_SESSION['user_id']);

            if ($miseListe) {
                return View::render('mise/index', ['mise' => $miseListe]);
            } else {
                return View::render('mise/index');
            }
        }
    }
}
