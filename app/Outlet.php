<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $guarded = [];

    public function package()
    {
        return $this->hasOne(Package::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
