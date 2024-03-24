<?php

namespace App\Models;

use App\Models\CRUD;

class Image extends CRUD
{
    protected $table = 'stampee_images';
    protected $primaryKey = 'id';
    protected $fillable = ['stampee_produit_id', 'image'];
}
