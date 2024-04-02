<?php

namespace App\Models;

use App\Models\CRUD;

class Enchere extends CRUD
{
    protected $table = 'stampee_encheres';
    protected $primaryKey = 'id';
    protected $fillable = ['stampee_produit_id', 'dateTime', 'prix', 'prixActuel', 'coupdecoeur', 'dateFinal'];


    public function deleteByProductId($id)
    {
        $sql = "DELETE FROM stampee_encheres WHERE stampee_produit_id = $id;";

        if ($stmt = $this->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function selectEnchereById($value)
    {
        $sql = "SELECT * FROM stampee_encheres WHERE id = $value";
        if ($stmt = $this->query($sql)) {

            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function updatePrixActuel($prixActuel, $idEnchere)
    {
        $sql = "UPDATE stampee_encheres SET prixActuel = $prixActuel WHERE id = $idEnchere;";

        if ($stmt = $this->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
