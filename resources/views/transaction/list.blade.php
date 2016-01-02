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
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.content -->

@endsection
