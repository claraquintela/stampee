<?php

namespace App\Models;

use App\Models\CRUD;

class Mise extends CRUD
{
    protected $table = 'stampee_miser';
    protected $primaryKey = 'id';
    protected $fillable = ['stampee_users_id', 'offre', 'date', 'encheres_id'];


    public function selectMiseByUser($value)
    {
        $sql = " SELECT  stampee_miser.*, stampee_produit.nom, stampee_produit.id as product_id FROM stampee_miser
                inner join stampee_encheres on encheres_id = stampee_encheres.id
                inner join stampee_produit on stampee_produit.id = stampee_encheres.stampee_produit_id
                WHERE stampee_miser.stampee_users_id = $value;";

        if ($stmt = $this->query($sql)) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }


    
}
