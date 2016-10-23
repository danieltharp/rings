<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $connection='character';
    protected $table='characters';
    public $timestamps=false;
    protected $primaryKey='guid';

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'guid');
    }
}
