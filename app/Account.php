<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;
use \NumberFormatter;
use \Locale;

class Account extends Model
{
    protected $fillable = ['title','startbalance','user_id'];

    public function owner() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function getStartbalanceFormattedAttribute() {
        return number_format ( $this->startbalance ,2, ",", "." );
    }

    public function setStartbalanceAttribute($value) {
        $locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $fmt = new NumberFormatter( $locale, NumberFormatter::DECIMAL );
        $this->attributes['startbalance'] = $fmt->parse($value);
    }

    public function getCurrentBalanceAttribute() {
        $transactions = $this->transactions;
        return number_format((float)$this->startbalance + $transactions->sum('amount'),2,",",".");
    }

    public function getCurrentBalanceRawAttribute() {
        $transactions = $this->transactions;
        return (float)$this->startbalance + $transactions->sum('amount');
    }
}
