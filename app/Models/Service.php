<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'categurie_id',
        'icon'
    ];

    public function catiguries()
    {
        return $this->belongsTo('App\Models\Catiguries', 'categurie_id', 'id');
    }

    public function consoles()
    {
        return $this->belongsToMany(Console::class, 'console_services');
    }
}
