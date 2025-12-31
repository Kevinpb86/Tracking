<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoItem extends Model
{
    protected $fillable = [
        'vbeln',
        'posnr',
        'matnr',
        'arktx',
        'ifimg',
        'vrkme',
    ];
    //
}
