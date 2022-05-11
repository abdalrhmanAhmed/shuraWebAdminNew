<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catiguries extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->hasMany('App\Models\Service', 'catigurie_id', 'id');
    }
}
