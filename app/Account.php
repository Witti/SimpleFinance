<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['title','startbalance','user_id'];

    public function owner() {
        return $this->belongsTo(User::class);
    }
}
