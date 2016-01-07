@extends('layouts.app')

@section('content')
        <!-- Main content -->
        <section class="content">
            @include('layouts.partials.alert')
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Transaction for {{ $account->title }}</h3>
                    <div class="box-tools pull-right">
                        <a class="btn btn-box-tool" href="{{ url('/transaction/create/account', ['id' => $account->id]) }}" title="Add new account"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="pull-right" style="margin-bottom:1em;">
                        <strong>Current balance {{ number_format ( $currentbalance ,2, ",", "." ) }}</strong>
                    </div>
                    <div style="clear:both;"></div>
                    <table id="transactionstable" class="table table-striped table-hover">
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
                        @foreach($transactions as $t)
                            <tr class="@if($t->type == "expense") warning @else success @endif">
                                <td>
                                    {{ $t->transactiondate }}
                                </td>
                                <td>
                                    @if($t->transfer_id)
                                        <a href="{{ url('/transaction/account', ['id' => $t->transferTransaction->account->id]) }}" data-toggle="tooltip" data-placement="top" title="Transfer - {{ $t->transferTransaction->account->title }}"><i class="fa fa-retweet"></i></a>
                                    @endif
                                    {{ $t->label }}
                                </td>
                                <td>
                                    {{ $t->category->title }}
                                </td>
                                <td align="right">
                                    {{ $t->amountFormatted }}
                                </td>
                                <td align="right">
                                    <a href="{{ url('/transaction/edit', ['id' => $t->id]) }}" class="text-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a class="text-danger delthis" href="{{ url('/transaction/delete', ['id' => $t->id]) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <strong>Current balance {{ number_format ( $currentbalance ,2, ",", "." ) }}</strong>
                    </div>
                </div>
            </div><!-- /.box -->
        </section><!-- /.content -->

@endsection
