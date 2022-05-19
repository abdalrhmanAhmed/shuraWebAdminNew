<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsoleFiles extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table="console_files";
}
