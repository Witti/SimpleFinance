<?php

namespace SimpleFinance;

use Illuminate\Database\Eloquent\Model;
use \Numberformatter;
use \IntlDateFormatter;
use \Locale;

use Jedrzej\Searchable\SearchableTrait;

class Transaction extends Model
{

    use SearchableTrait;

    public $searchable = ['label'];
    protected $fillable = ['label','amount','type'];
    protected $dates = ['created_at', 'updated_at', 'transactiondate'];
    public $locale = false;

    public function __construct()
    {
        $this->locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getAmountFormattedAttribute() {
        return number_format ( $this->attributes['amount'] ,2, ",", "." );
    }

    public function setAmountAttribute($value) {
        $fmt = new NumberFormatter( $this->locale, NumberFormatter::DECIMAL );
        $this->attributes['amount'] = $fmt->parse($value);

        if($this->attributes['amount'] > 0 && $this->type == 'expense') {
            $this->attributes['amount'] = $this->attributes['amount'] * -1;
        }

        if($this->attributes['amount'] < 0 && $this->type == 'income') {
            $this->attributes['amount'] = $this->attributes['amount'] * -1;
        }
    }

    public function getTransactiondateAttribute($value) {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::SHORT,
            IntlDateFormatter::NONE,
            config('app.timezone'),
            IntlDateFormatter::GREGORIAN
        );
        return $fmt->format(strtotime($value));
    }

    public function transferTransaction() {
        return $this->belongsTo(Transaction::class,'transfer_id','id');
    }

    public function lending() {
        return $this->belongsTo(Lending::class, 'lending_id','id');
    }
}
