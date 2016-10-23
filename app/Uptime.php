<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uptime extends Model
{
    protected $connection='auth';
    protected $table='uptime';
    public $timestamps=false;

    public function realm()
    {
        return $this->belongsTo(Realm::class);
    }
}
