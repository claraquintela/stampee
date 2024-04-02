<?php

namespace App\Controllers;

use App\Models\Enchere;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Models\Product;
use DateTime;

class EnchereController
{

    public function index()
    {
        $enchere = new Enchere;
        $encheres = $enchere->select();

        $data = []; // Array para armazenar os dados dos produtos e imagens

        foreach ($encheres as $enchere) {
            $product = new Product;
            $selectId = $product->selectId($enchere['stampee_produit_id']);
            $image = $product->getImage($enchere['stampee_produit_id']);


            if ($selectId) {
                // Adicionar os dados do produto e da imagem ao array de dados
                $data[] = [
                    'product' => $selectId,
                    'image' => $image,
                    'id' => $enchere['id'],
                    'dateFinal' => $enchere['dateFinal']
                ];
            } else {
                // Tratar o caso em que nenhum produto é encontrado
                return View::render('error');
            }
        }
        // Renderizar a view fora do loop, passando os dados acumulados como contexto
        return View::render('enchere/index', ['data' => $data]);
    }


    public function activer($data = [])
    {
        $product = new Product;
        $selectId = $product->selectId($data['stampee_produit_id']);

        if ($selectId) {
            return View::render('enchere/create', ['product' => $selectId]);
        } else {
            return View::render('error');
        }
    }

    public function store($data)
    {
        $validator = new Validator;
        $data['dateTime'] = date('Y-m-d H:i:s');
        $validator->field('prix', $data['prix'])->required()->min(2)->max(100);

        $dateFinal = new DateTime('now');
        date_add($dateFinal, date_interval_create_from_date_string($data['duree-enchere'] . " days"));

        $data['dateFinal'] =  $dateFinal->format('Y-m-d H:i:s');


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
        $product = new Product;
        $updateStatus = $product->updateStatusProduct($data['stampee_produit_id'], $data['status']);

        if ($updateStatus) {
            return View::redirect('product/index');
        } else {
            return View::render('error');
        }
    }


    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $product = new Product;
            $selectId = $product->selectId($data['id']);
            $image = $product->getImage($data['id']);

            if ($selectId) {
                return View::render('enchere/show', ['product' => $selectId, 'image' => $image]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function like(){
        
    }

    public function dislike(){

    }


}
