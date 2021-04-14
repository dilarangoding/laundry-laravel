<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];


    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

}
