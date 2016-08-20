@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
    @include('layouts.partials.alert')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Repeated Transactions</h3>
                <div class="box-tools pull-right">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-s dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            add transaction
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuaddTransaction">
                            <li><a href="{{ url('/transaction/create') }}" class="text-primary" title="edit lending"><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i>regular transaction</a></li>
                            <li><a href="{{ url('/transaction/repeated/create') }}" class="text-primary" title="edit lending"><i class="fa fa-repeat"></i>repeated transaction</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div style="clear:both;"></div>
                <table id="transactionstable" class="table table-striped table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>Startdate</th>
                        <th>Interval</th>
                        <th>Label</th>
                        <th>Amount</th>
                        <th class="hidden-xs">Category</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $t)
                        <tr>
                            <td>{{ $t->startdate }}</td>
                            <td>repeat {{ $t->rmodeRuleFormated }}</td>
                            <td>{{ $t->label }}</td>
                            <td>{{ $t->amountFormatted }}</td>
                            <td class="hidden-xs">{{ $t->category->title }}</td>
                            <td align="right">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="editDropdown{{ $t->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Edit
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{ url('/transaction/repeated/edit', ['id' => $t->id]) }}" class="text-primary"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a></li>
                                        <li><a class="text-primary delthis" href="{{ url('/transaction/repeated/delete', ['id' => $t->id]) }}"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">

                </div>
            </div>
        </div><!-- /.box -->
    </section><!-- /.content -->

@endsection
