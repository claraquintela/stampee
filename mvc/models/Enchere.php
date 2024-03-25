<?php

namespace App\Models;

use App\Models\CRUD;

class Enchere extends CRUD
{
    protected $table = 'stampee_encheres';
    protected $primaryKey = 'id';
    protected $fillable = ['stampee_produit_id', 'dateTime', 'prixInitial', 'prixInitial', 'prixActuel', 'stampee_miser_id', 'coupdecoeur'];
}
