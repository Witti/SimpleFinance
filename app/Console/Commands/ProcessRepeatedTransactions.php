<?php

namespace SimpleFinance\Console\Commands;

use Illuminate\Console\Command;
use When\When;
use Carbon\Carbon;
use SimpleFinance\RepatedTransaction;
use SimpleFinance\Transaction;

class ProcessRepeatedTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:processrepeated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes the repeating transactions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Collecting data for transactions.');
        $transactions = RepatedTransaction::all();

        $this->info('Starting transaction processing.');
        foreach($transactions as $t) {
            $r = new When();
            $r->startDate($t->startdateRaw)->freq($t->rmodeRuleFormated);
            if($r->occursOn(New Carbon())) {
                $this->info('Creating transaction - ' . $t->label);
                $transaction = New Transaction();
                $transaction->account_id = $t->account_id;
                $transaction->category_id = $t->category_id;
                $transaction->label = $t->label;
                $transaction->type = $t->type;
                $transaction->transactiondate = New Carbon();
                $transaction->amount = $t->amount;
                $transaction->save();

                if($t->transfer_account_id && $t->transfer) {
                    if (Input::get('type') == 'expense') {
                        $transferTransactionType = 'income';
                    } else {
                        $transferTransactionType = 'expense';
                    }

                    $transferTransaction = Transaction::findOrNew($transaction->transfer_id);
                    $transferTransaction->account_id = $t->transfer_account_id;
                    $transferTransaction->category_id = $t->category_id;
                    $transferTransaction->label = $t->label;
                    $transferTransaction->type = $transferTransactionType;
                    $transferTransaction->transactiondate = New Carbon();
                    $transferTransaction->amount = $t->amount;
                    $transferTransaction->transfer_id = $transaction->id;
                    $transferTransaction->save();

                    $transaction->transfer_id = $transferTransaction->id;
                    $transaction->save();
                }
            }
        }
        $this->info('Job done, see you tomorrow.');
    }
}
