@extends('layouts.app')

@section('content')
        <!-- Main content -->
<section class="content">
    @include('layouts.partials.alert')
            <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Account edit - {{ $account->title }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ url('/account/delete', ['id' => $account->id]) }}" class="text-danger delthis">Delete account</a>
            </div>
        </div>
        <div class="box-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/update') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{ $account->id }}">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{ $account->title }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Startbalance</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="startbalance" value="{{ $account->startbalanceFormatted }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('startbalance') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-piggy-bank"></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection
