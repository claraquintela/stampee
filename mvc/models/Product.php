<?php

namespace App\Models;

use App\Models\CRUD;

class Product extends CRUD
{
    protected $table = 'stampee_produit';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'identifiant', 'description', 'annee', 'pays', 'certifie', 'condition', 'stampee_users_id', 'prix', 'dateTime'];
}
