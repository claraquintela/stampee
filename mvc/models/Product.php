<?php

namespace App\Models;

use App\Models\CRUD;

class Product extends CRUD
{
    protected $table = 'stampee_produit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom', 'description', 'annee', 'pays', 'certifie',
        'condition_timbre', 'stampee_users_id', 'prix', 'dateTime'
    ];


    public function insert($data)
    {
        $insert = parent::insert($data);

        if ($insert) {
            $image = new Image;
            $dataImage = array(
                "stampee_produit_id" => $insert,
                "image" => $data['image'],
            );

            $insertImage = $image->insert($dataImage);

            if ($insertImage) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
