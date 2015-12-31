<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;
use \Numberformatter;
use \Locale;

class Transaction extends Model
{
    protected $fillable = ['label','amount','type'];

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getAmountAttribute($value) {
        return number_format ( $value ,2, ",", "." );
    }

    public function setAmountAttribute($value) {
        $locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $fmt = new NumberFormatter( $locale, NumberFormatter::DECIMAL );
        $this->attributes['amount'] = $fmt->parse($value);
    }
}
