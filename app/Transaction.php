<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['label','amount','type'];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
