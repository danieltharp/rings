<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
    protected $connection='auth';
    protected $table='realmlist';
    public $timestamps=false;

    public function databases()
    {
        return $this->hasMany(Database::class);
    }

    public function uptime()
    {
        return $this->hasMany(Uptime::class, 'realmid');
    }

}