@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit lending entry</h3>
        </div>
        <div class="box-body">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/lending/update/' . $lending->id) }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Firstname</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="firstname" value="{{ $lending->person->firstname }} }}">

                            @if ($errors->has('firstname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Lastname</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="lastname" value="{{ $lending->person->lastname }}">

                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="{{ $lending->person->email }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Phone</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" value="{{ $lending->person->phone }}">

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Due date</label>

                        <div class="col-md-6">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="deadline" value="{{ date('d.m.Y',strtotime($lending->deadline)) }}" data-date-format="dd.mm.yyyy"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>

                            @if ($errors->has('deadline'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deadline') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update lending
                            </button>
                            <a href="#" class="btn btn-success">
                                Close lending (got the money)
                            </a>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section><!-- /.content -->
@endsection
