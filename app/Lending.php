<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    public $timestamps = false;

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }
}
