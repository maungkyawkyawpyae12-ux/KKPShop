<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softdeletes;

class Category extends Model
{
    use Hasfactory;
    use softDeletes;
    protected $table='categories';
    protected $filllable=[
        'name',
        'image'
    ];
}
