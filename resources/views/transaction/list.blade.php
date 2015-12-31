@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Transaction for {{ $account->title }}</div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Created (temp id)</th>
                                    <th>Label</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $t)
                                    <tr class="@if($t->type == "expense") warning @else success @endif">
                                        <td>
                                            {{ $t->id }}
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
                                    </tr>
                                @endforeach
                                <tr class="@if($currentbalance < 0) danger @endif">
                                    <td colspan="4" align="right"><strong>{{ $currentbalance }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer"><a href="{{ url('/transaction/create/account', ['id' => $account->id]) }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
