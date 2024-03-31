<?php

namespace App\Models;

use App\Models\CRUD;

class Product extends CRUD
{
    protected $table = 'stampee_produit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom', 'description', 'annee', 'pays', 'certifie',
        'condition_timbre', 'stampee_users_id', 'prix', 'dateTime', 'status'
    ];

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SOLD = 2;


    public function insert($data)
    {
        $insert = parent::insert($data);

        error_log($insert);
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

    public function getImage($id)
    {
        $sql = "SELECT * FROM stampee_images WHERE stampee_produit_id = $id";

        if ($stmt = $this->query($sql)) {

            $queryResults = $stmt->fetchAll();

            return $queryResults[0]['image'];
        } else {
            return false;
        }
    }

    public function updateStatusProduct($id, $status)
    {
        $sql = "UPDATE stampee_produit SET status = $status WHERE id = $id;";

        if ($stmt = $this->query($sql)) {

            if ($status == 0) {
                $enchere = new Enchere;
                if ($enchere->deleteByProductId($id)) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
}
