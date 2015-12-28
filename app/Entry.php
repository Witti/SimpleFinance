<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = "entries";

    protected $fillable = ['label','amount','type'];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
