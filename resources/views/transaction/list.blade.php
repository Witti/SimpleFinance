@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Transaction for {{ $account->title }}<a class="pull-right" href="{{ url('/transaction/create/account', ['id' => $account->id]) }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Label</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="@if($currentbalance < 0) danger @endif">
                                    <td>&nbsp;</td>
                                    <td align="left"><strong>Current balance</strong></td>
                                    <td colspan="2" align="right"><strong>{{ number_format ( $currentbalance ,2, ",", "." ) }}</strong></td>
                                    <td>&nbsp;</td>
                                </tr>
                                @foreach($transactions as $t)
                                    <tr class="@if($t->type == "expense") warning @else success @endif">
                                        <td>
                                            {{ $t->transactiondate }}
                                        </td>
                                        <td>
                                            {{ $t->label }}
                                        </td>
                                        <td>
                                            {{ $t->category->title }}
                                        </td>
                                        <td align="right">
                                            {{ $t->amount }}
                                        </td>
                                        <td align="right">
                                            <a href="{{ url('/transaction/edit', ['id' => $t->id]) }}" class="text-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a class="text-danger delthis" href="{{ url('/transaction/delete', ['id' => $t->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
