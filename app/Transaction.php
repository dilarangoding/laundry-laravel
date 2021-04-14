<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
 
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasMany(Transaction_detail::class);
    }
    
}
