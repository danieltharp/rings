<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{

    protected $connection = 'rings';
    public $timestamps=false;

    public function realm()
    {
        return $this->belongsTo(Realm::class);
    }
}
