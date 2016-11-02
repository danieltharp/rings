<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public $guarded = [];
    public function realm()
    {
        return $this->belongsTo(Realm::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
