<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['title','color'];
    public $timestamps = false;

    public function owner() {
        return $this->belongsTo(User::class);
    }
}
