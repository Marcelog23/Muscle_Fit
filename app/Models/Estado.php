<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
      'nome_estd', 'sigl_estd'
    ];
}
