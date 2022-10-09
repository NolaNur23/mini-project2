<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use HasFactory,softDeletes;

    public function Major()
    {
        return $this->belongsTo('App\Models\Majors', 'id_majors');
    }

}
