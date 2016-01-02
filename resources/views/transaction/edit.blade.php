@extends('layouts.app')

@section('content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">New Account</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/transaction/update', ['id' => $transaction->id]) }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Type</label>

                                <div class="col-md-6">
                                    {!! Form::select('type', ['expense' => 'Expense','income' => 'Income'], $transaction->type,['class' => 'selectpicker']) !!}

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('accountid') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Account</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="accountname" value="{{ $transaction->account->title }}" disabled="disabled">

                                    @if ($errors->has('accountid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('accountid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">
                                    {!! Form::select('category_id', $categories, $transaction->category_id,['class' => 'selectpicker']) !!}

                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Label</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="label" value="{{ $transaction->label }}">

                                    @if ($errors->has('label'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('label') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Amount</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="amount" value="{{ $transaction->amount }}">

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Amount</label>

                                <div class="col-md-6">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="transactiondate" value="@if( $transaction->transactiondate != '0000-00-00'){{ date('d.m.Y',strtotime($transaction->transactiondate)) }}@else{{ $transaction->created_at->format('d.m.Y') }}@endif" data-date-format="dd.mm.yyyy"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update transaction
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
