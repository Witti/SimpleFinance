@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('layouts.partials.alert')
                <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">New Transaction for {{ $account->title }}</h3>
            </div>
            <div class="box-body">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/transaction/store') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                {!! Form::select('type', ['expense' => 'Expense','income' => 'Income'], old('type'),['class' => 'selectpicker']) !!}

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
                                <input type="text" class="form-control" name="accountname" value="{{ $account->title }}" disabled="disabled">
                                <input type="hidden" name="accountid" value="{{ $account->id }}">

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
                                {!! Form::select('category_id', $categories, old('category_id'),['class' => 'selectpicker']) !!}

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
                                <input type="text" class="form-control" name="label" value="{{ old('label') }}">

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
                                <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('transactiondate') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="transactiondate" value="{{ old('transactiondate',date('d.m.Y')) }}" data-date-format="dd.mm.yyyy"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>

                                @if ($errors->has('transactiondate'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('transactiondate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('transfer') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Transfer</label>

                            <div class="col-md-6">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="transfer" class="transfer-checkbox">
                                    </label>
                                </div>

                                @if ($errors->has('transfer'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('transfer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lending') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Create lending</label>

                            <div class="col-md-6">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="lending" class="lending-checkbox">
                                    </label>
                                </div>

                                @if ($errors->has('lending'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lending') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="transfer-account-fg form-group{{ $errors->has('transfer_account_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Transferaccount</label>

                            <div class="col-md-6">
                                {!! Form::select('transfer_account_id', $accounts, old('transfer_account_id'),['class' => 'selectpicker']) !!}

                                @if ($errors->has('transfer_account_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transfer_account_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create transaction
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
    </section><!-- /.content -->
@endsection
